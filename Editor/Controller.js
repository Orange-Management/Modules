import { Autoloader } from '../../jsOMS/Autoloader.js';
import { Application } from '../../Web/Backend/js/backend.js';
import { Editor } from './Models/Editor.js';

Autoloader.defineNamespace('jsOMS.Modules');

jsOMS.Modules.Editor = class {
    constructor(app)
    {
        this.app     = app;
        this.editors = {};
    };

    bind (id)
    {
        const e    = typeof id === 'undefined' ? document.getElementsByClassName('m-editor') : [id],
            length = e.length;

        for (let i = 0; i < length; ++i) {
            this.bindElement(e[i].id);
        }
    };

    bindElement (id)
    {
        if (typeof id === 'undefined' || !id) {
            // todo: do logging

            return;
        }

        this.editors[id] = new Editor(id);
        this.editors[id].bind();
    };
};

window.omsApp.moduleManager.get('Editor').bind();