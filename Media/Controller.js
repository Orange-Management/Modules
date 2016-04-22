(function (jsOMS, undefined) {
    jsOMS.Autoloader.defineNamespace('jsOMS.Modules');

    jsOMS.Modules.Media = function (app) {
        this.app = app;
    };

    jsOMS.Modules.Media.prototype.bind = function () {
        let forms = document.getElementsByTagName('form');

        /* Handle media forms */
        for (let c = 0; c < forms.length; c++) {
            let self = this;

            if(typeof forms[i].querySelector('input[type=file]') !== 'undefined') {
                this.app.uiManager.getFormManager().get(forms[c].id).injectSubmit(function (e) {
                    let fileFields = e.querySelectorAll('input[type=file]'),
                        uploader = new jsOMS.Modules.Media.Models.Upload(self.app.responseManager);

                    uploader.setSuccess(e.id, function (type, response) {
                        e.querySelector('input[type=file]+input[type=hidden]').value = JSON.stringify(response.uploads);

                        let data = self.app.uiManager.getFormManager().getData(e);
                        self.app.uiManager.getFormManager().submit(e, data);
                    });

                    uploader.setUri(jsOMS.Uri.UriFactory.build(Url + '/{lang}/api/media'));

                    for (let i = 0; i < fileFields.length; i++) {
                        for (let j = 0; j < fileFields[i].files.length; j++) {
                            uploader.addFile(fileFields[i].files[j]);
                        }
                    }

                    uploader.upload(e.id);
                });
            }
        }
    }
}(window.jsOMS = window.jsOMS || {}));

jsOMS.ready(function () {
    window.omsApp.moduleManager.initModule('Media');
    window.omsApp.moduleManager.get('Media').bind();
});
