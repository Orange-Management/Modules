(function (jsOMS)
{
    "use strict";

    jsOMS.Autoloader.defineNamespace('jsOMS.Modules');

    jsOMS.Modules.Media = function (app)
    {
        this.app = app;
    };

    jsOMS.Modules.Media.prototype.bind = function (id)
    {
        const e    = typeof id === 'undefined' ? document.getElementsByTagName('form') : [document.getElementById(id)],
            length = e.length;

        for (let i = 0; i < length; ++i) {
            this.bindElement(e[i]);
        }
    };

    jsOMS.Modules.Media.prototype.bindElement = function (form)
    {
        if (typeof form === 'undefined' || !form) {
            // todo: do logging here

            return;
        }

        const self = this;

        if (!form.querySelector('input[type=file]') || !document.querySelector('input[type=file][form=' + form.id + ']')) {
            try {
                // Inject media upload into form view
                this.app.uiManager.getFormManager().get(form.id).injectSubmit(function (e, requestId)
                {
                    /** global: jsOMS */
                    let fileFields = document.querySelectorAll(
                            '#' + e.id + ' input[type=file], '
                            + 'input[form=' + e.id + '][type=file]'
                        ),
                        uploader   = new jsOMS.Modules.Models.Media.Upload(self.app.responseManager);

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
                        return;
                    }

                    uploader.upload(e.id);
                });
            } catch (e) {
                this.app.logger.info('Tried to add media upload support for form without an ID.');
            }
        }
    };
}(window.jsOMS = window.jsOMS || {}));

jsOMS.ready(function ()
{
    "use strict";

    window.omsApp.moduleManager.get('Media').bind();
});
