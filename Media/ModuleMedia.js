(function (jsOMS, undefined) {
    jsOMS.Modules.Models.Media = typeof jsOMS.Modules.Models.Media == 'undefined' ? {} : jsOMS.Modules.Models.Media;

    jsOMS.Modules.Models.Media.Upload = function (responseManager) {
        this.responseManager = responseManager;
        this.success = [];

        this.uri = '';
        this.allowedTypes = [];
        this.maxFileSize = 0;
        this.files = [];
    };

    jsOMS.Modules.Models.Media.Upload.prototype.setSuccess = function (id, callback) {
        this.success[id] = callback;
    };

    jsOMS.Modules.Models.Media.Upload.prototype.setUri = function (uri) {
        this.uri = uri;
    };

    jsOMS.Modules.Models.Media.Upload.prototype.setAllowedTypes = function (allowed) {
        this.allowedTypes = allowed;
    };

    jsOMS.Modules.Models.Media.Upload.prototype.addAllowedType = function (allowed) {
        this.allowedTypes.push(allowed);
    };

    jsOMS.Modules.Models.Media.Upload.prototype.setMaxFileSize = function (size) {
        this.maxFileSize = size;
    };

    jsOMS.Modules.Models.Media.Upload.prototype.addFile = function (file) {
        this.files.push(file);
    };

    jsOMS.Modules.Models.Media.Upload.prototype.upload = function (formId) {
        // TODO: validate file type + file size

        var request = new jsOMS.Message.Request(),
            formData = new FormData(),
            self = this;

        this.files.forEach(function (element, index) {
            formData.append('file' + index, element);
        });

        request.setData(formData);
        request.setType('raw');
        request.setUri(this.uri);
        request.setMethod('POST');
        request.setRequestHeader('HTTP_X_REQUESTED_WITH', 'XMLHttpRequest');
        request.setSuccess(function (xhr) {
            console.log(xhr); // TODO: remove this is for error checking
            var o = JSON.parse(xhr.response),
                response = Object.keys(o).map(function (k) {
                    return o[k];
                });

            console.log(response);

            for (var k = 0; k < response.length; k++) {
                if (response[k] !== null) {
                    if (!self.success[formId]) {
                        self.responseManager.execute(response[k].type, response[k]);
                    } else {
                        self.success[formId](response[k].type, response[k]);
                    }
                }
            }
        });
        request.send();
    };
}(window.jsOMS = window.jsOMS || {}));
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

                uploader.setUri('http://127.0.0.1/en/api/media');

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
    window.omsApp.moduleManager.get('Media').bind();
});
