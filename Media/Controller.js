(function (jsOMS)
{
    jsOMS.Autoloader.defineNamespace('jsOMS.Modules');

    jsOMS.Modules.Media = function (app)
    {
        this.app = app;
    };

    jsOMS.Modules.Media.prototype.bind = function ()
    {
        let forms = document.getElementsByTagName('form');

        /* Handle media forms */
        for (let i = 0; i < forms.length; i++) {
            let self = this;

            if (typeof forms[i].querySelector('input[type=file]') !== 'undefined') {
                try {
                    this.app.uiManager.getFormManager().get(forms[i].id).injectSubmit(function (e, requestId, requestGroup)
                    {
                        let fileFields = e.querySelectorAll('input[type=file]'),
                            uploader   = new jsOMS.Modules.Models.Media.Upload(self.app.responseManager, self.app.logger);

                        uploader.setSuccess(e.id, function (type, response)
                        {
                            e.querySelector('input[type=file]+input[type=hidden]').value = JSON.stringify(response.uploads);
                            self.app.eventManager.triggerDone(requestId, requestGroup);
                        });

                        uploader.setUri(Url + '{/lang}/api/media');

                        for (let i = 0; i < fileFields.length; i++) {
                            for (let j = 0; j < fileFields[i].files.length; j++) {
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
        }
    };
}(window.jsOMS = window.jsOMS || {}));

jsOMS.ready(function ()
{
    window.omsApp.moduleManager.get('Media').bind();
});
