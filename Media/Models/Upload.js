(function (jsOMS, undefined) {
    jsOMS.Autoloader.defineNamespace('jsOMS.Modules.Media.Models');

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

        var request = new jsOMS.Message.Request.Request(),
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
