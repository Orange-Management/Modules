(function (jsOMS, undefined) {
    jsOMS.Modules.Draw = function (app) {
        this.app = app;
        this.editors = [];
    };

    jsOMS.Modules.Draw.prototype.bind = function (id) {
        var temp = null;

        if (typeof id !== 'undefined') {
            temp = new jsOMS.Modules.Draw.Editor(document.getElementById(id));
            temp.bind();

            this.editors.push(temp);
        } else {
            var canvas = document.getElementsByClassName('m-draw');

            this.editors = [];

            /* Handle media forms */
            for (var c = 0; c < canvas.length; c++) {
                temp = new jsOMS.Modules.Draw.Editor(canvas[c]);
                temp.bind();

                this.editors.push(temp);
            }
        }
    }

    jsOMS.Modules.Draw.prototype.getElements = function() {
        return this.editors;
    }

    jsOMS.Modules.Draw.prototype.count = function() {
        return this.editors.length;
    }
}(window.jsOMS = window.jsOMS || {}));

jsOMS.ready(function () {
    window.omsApp.moduleManager.initModule('Draw');
    window.omsApp.moduleManager.get('Draw').bind();
});
