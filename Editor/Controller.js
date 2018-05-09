(function (jsOMS)
{
    "use strict";

    jsOMS.Autoloader.defineNamespace('jsOMS.Modules');

    jsOMS.Modules.Editor = function(app)
    {
        this.app     = app;
        this.editors = {};
    };

    jsOMS.Modules.Editor.prototype.bind = function(id)
    {
        const e    = typeof id === 'undefined' ? document.getElementsByClassName('m-editor') : [id],
            length = e.length;

        for(let i = 0; i < length; i++) {
            this.bindElement(e[i].id);
        }
    };

    jsOMS.Modules.Editor.prototype.bindElement = function(id)
    {
        if(typeof id === 'undefined' || !id) {
            // todo: do logging

            return;
        }

        this.editors[id] = new jsOMS.Modules.Models.Editor.Editor(id);
        this.editors[id].bind();
    };
}(window.jsOMS = window.jsOMS || {}));

jsOMS.ready(function ()
{
    "use strict";

    window.omsApp.moduleManager.get('Editor').bind();
});
