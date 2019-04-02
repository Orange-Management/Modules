import { Autoloader } from '../../jsOMS/Autoloader.js';
import { Application } from '../../Web/Backend/js/backend.js';
import { Upload } from './Models/Upload.js';

Autoloader.defineNamespace('jsOMS.Modules');

jsOMS.Modules.Media = class {
    /**
     * @constructor
     *
     * @since 1.0.0
     */
    constructor  (app)
    {
        this.app = app;
    };

    bind (id)
    {
        const e    = typeof id === 'undefined' ? document.getElementsByTagName('form') : [document.getElementById(id)],
            length = e.length;

        for (let i = 0; i < length; ++i) {
            this.bindElement(e[i]);
        }
    };

    bindElement (form)
    {
        if (typeof form === 'undefined' || !form) {
            jsOMS.Log.Logger.instance.error('Invalid form: ' + form, 'MediaController');

            return;
        }

        const self = this;

        if (!form.querySelector('input[type=file]')
            || !document.querySelector('input[type=file][form=' + form.id + ']')
        ) {
            try {
                // Inject media upload into form view
                this.app.uiManager.getFormManager().get(form.id).injectSubmit(function (e, requestId)
                {
                    // todo: what if a form needs multiple different upload fields which should not be mixed

                    /** global: jsOMS */
                    const fileFields = document.querySelectorAll(
                            '#' + e.id + ' input[type=file], '
                            + 'input[form=' + e.id + '][type=file]'
                        );
                    const uploader   = new Upload(self.app.responseManager);

                    uploader.setSuccess(e.id, function (type, response)
                    {
                        document.querySelector('input[form=' + e.id + '][type=file]+input[form=' + e.id + '][type=hidden]').value = JSON.stringify(response);
                        self.app.eventManager.trigger(form.id, requestId);
                    });

                    uploader.setUri('{/base}/{/lang}/api/media');

                    const length   = fileFields.length;
                    let fileLength = 0;

                    for (let i = 0; i < length; ++i) {
                        fileLength = fileFields[i].files.length;
                        for (let j = 0; j < fileLength; ++j) {
                            uploader.addFile(fileFields[i].files[j]);
                        }
                    }

                    if (uploader.count() < 1) {
                        self.app.eventManager.trigger(form.id, requestId);
                        return;
                    }

                    uploader.upload(e.id);
                });
            } catch (e) {
                this.app.logger.info('Tried to add media upload support for form without an ID.');
            }
        }
    };
};

window.omsApp.moduleManager.get('Media').bind();
