import { Logger } from '../../../jsOMS/Log/Logger.js';
import { Request } from '../../../jsOMS/Message/Request/Request.js';
import { RequestMethod } from '../../../jsOMS/Message/Request/RequestMethod.js';
import { RequestType } from '../../../jsOMS/Message/Request/RequestType.js';

/**
 * Media uploader.
 *
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @since      1.0.0
 */
export class Upload {
    /**
     * @constructor
     *
     * @param {Object} responseManager Response manager
     *
     * @since 1.0.0
     */
    constructor (responseManager)
    {
        this.responseManager = responseManager;
        this.success         = [];

        this.uri          = '';
        this.allowedTypes = [];
        this.maxFileSize  = 0;
        this.files        = [];
    };

    /**
     * Set max allowed file size.
     *
     * @param {int} size Max file size
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    setMaxFileSize (size)
    {
        this.maxFileSize = size;
    };

    /**
     * Get max allowed file size.
     *
     * @return {int} Max file size
     *
     * @since 1.0.0
     */
    getMaxFileSize ()
    {
        return this.maxFileSize;
    };

    /**
     * Set success callback.
     *
     * @param {string}   id       Form id
     * @param {function} callback Function callback on success
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    setSuccess (id, callback)
    {
        this.success[id] = callback;
    };

    /**
     * Set upload uri.
     *
     * @param {string} uri Upload destination
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    setUri (uri)
    {
        this.uri = uri;
    };

    /**
     * Set allowed upload file types.
     *
     * @param {Array} allowed Allowed upload file types
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    setAllowedTypes (allowed)
    {
        this.allowedTypes = allowed;
    };

    /**
     * Add allowed upload file type
     *
     * @param {string} allowed Allowed upload file type
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    addAllowedType (allowed)
    {
        this.allowedTypes.push(allowed);
    };

    /**
     * Add file to upload
     *
     * @param {string} file File to upload
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    addFile (file)
    {
        this.files.push(file);
    };

    /**
     * Get count of file to upload
     *
     * @return {int}
     *
     * @since 1.0.0
     */
    count ()
    {
        return this.files.length;
    };

    /**
     * Upload data from form
     *
     * @param {string} formId Form id
     *
     * @return {void}
     *
     * @todo Orange-Management/Modules#202
     *  Consider to use FormData
     *  Form data is currently submitted in two steps if it contains media files.
     *      1. Upload media data
     *      2. Submit form data
     *  Consider to use `FormData` in order to submit media files and form data at the same time.
     *
     * @since 1.0.0
     */
    upload (formId)
    {
        /**
         * @todo Orange-Management/Modules#207
         *  Validate file type and file size on the frontend before uploading
         */
        const request = new Request(),
            formData  = new FormData(),
            self      = this;

        this.files.forEach(function (element, index)
        {
            formData.append('file' + index, element);
        });

        request.setData(formData);
        request.setType(RequestType.FORM_DATA);
        request.setUri(this.uri);
        request.setMethod(RequestMethod.PUT);
        request.setSuccess(function (xhr)
        {
            try {
                console.log(xhr.response);
                const response = JSON.parse(xhr.response);

                if (!self.success[formId]) {
                    self.responseManager.run(null, response);
                } else {
                    self.success[formId](null, response);
                }
            } catch (e) {
                console.log(e);
                Logger.instance.error(e);
                Logger.instance.error('Invalid media upload response: ' + xhr.response);
            }
        });

        request.send();
    };
};