(function (jsOMS)
{
    "use strict";

    jsOMS.Autoloader.defineNamespace('jsOMS.Modules.Models.Media');

    jsOMS.Modules.Models.Media.Upload = function (responseManager)
    {
        this.responseManager = responseManager;
        this.success         = [];

        this.uri          = '';
        this.allowedTypes = [];
        this.maxFileSize  = 0;
        this.files        = [];
    };

    jsOMS.Modules.Models.Media.Upload.prototype.setMaxFileSize = function (size)
    {
        this.maxFileSize = size;
    };

    jsOMS.Modules.Models.Media.Upload.prototype.getMaxFileSize = function (size)
    {
        return this.maxFileSize;
    };

    jsOMS.Modules.Models.Media.Upload.prototype.setSuccess = function (id, callback)
    {
        this.success[id] = callback;
    };

    jsOMS.Modules.Models.Media.Upload.prototype.setUri = function (uri)
    {
        this.uri = uri;
    };

    jsOMS.Modules.Models.Media.Upload.prototype.setAllowedTypes = function (allowed)
    {
        this.allowedTypes = allowed;
    };

    jsOMS.Modules.Models.Media.Upload.prototype.addAllowedType = function (allowed)
    {
        this.allowedTypes.push(allowed);
    };

    jsOMS.Modules.Models.Media.Upload.prototype.setMaxFileSize = function (size)
    {
        this.maxFileSize = size;
    };

    jsOMS.Modules.Models.Media.Upload.prototype.addFile = function (file)
    {
        this.files.push(file);
    };

    jsOMS.Modules.Models.Media.Upload.prototype.count = function ()
    {
        return this.files.length;
    };

    // todo: maybe do file upload together with data upload in FormData.
    // let the module forward the files to the media module?!
    jsOMS.Modules.Models.Media.Upload.prototype.upload = function (formId)
    {
        // TODO: validate file type + file size

        const request = new jsOMS.Message.Request.Request(),
            formData  = new FormData(),
            self      = this;

        this.files.forEach(function (element, index)
        {
            formData.append('file' + index, element);
        });

        request.setData(formData);
        request.setType(jsOMS.Message.Request.RequestType.FILE);
        request.setUri(this.uri);
        request.setMethod(jsOMS.Message.Request.RequestMethod.POST);
        request.setRequestHeader('HTTP_X_REQUESTED_WITH', 'XMLHttpRequest');
        request.setSuccess(function (xhr)
        {
            try {
                const response = JSON.parse(xhr.response);

                if (!self.success[formId]) {
                    self.responseManager.run(null, response);
                } else {
                    self.success[formId](null, response);
                }
            } catch (e) {
                console.log(e);
                jsOMS.Log.Logger.instance.error(e);
                jsOMS.Log.Logger.instance.error('Invalid media upload response: ' + xhr.response);
            }
        });

        request.send();
    };
}(window.jsOMS = window.jsOMS || {}));
