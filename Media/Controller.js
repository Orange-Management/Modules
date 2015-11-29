(function (jsOMS, undefined) {
    jsOMS.Modules.Media = function (app) {
        this.app = app;
    };

    jsOMS.Modules.Media.prototype.bind = function () {
        var forms = document.getElementsByTagName('form');

        /* Handle media forms */
        for (var c = 0; c < forms.length; c++) {
            var self = this;

            this.app.uiManager.getFormManager().injectSubmit(forms[c].id, function (e) {
                var fileFields = e.querySelectorAll('input[type=file]'),
                    uploader = new jsOMS.Modules.Models.Media.Upload(self.app.responseManager);

                uploader.setSuccess(e.id, function (type, response) {
                    e.querySelector('input[type=file]+input[type=hidden]').value = JSON.stringify(response.uploads);

                    var data = self.app.uiManager.getFormManager().getData(e);
                    self.app.uiManager.getFormManager().submit(e, data);
                });

                uploader.setUri('http://127.0.0.1/en/api/media.php');

                for (var i = 0; i < fileFields.length; i++) {
                    for (var j = 0; j < fileFields[i].files.length; j++) {
                        uploader.addFile(fileFields[i].files[j]);
                    }
                }

                uploader.upload(e.id);
            });
        }
    }
}(window.jsOMS = window.jsOMS || {}));

jsOMS.ready(function () {
    window.omsApp.moduleManager.initModule('Media');
    window.omsApp.moduleManager.get('Media').bind();
});
