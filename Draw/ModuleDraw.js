(function (jsOMS, undefined)
{
    jsOMS.Modules.Draw = function (app)
    {
        this.app = app;
        this.editors = [];
    };

    jsOMS.Modules.Draw.prototype.bind = function (id)
    {
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

    jsOMS.Modules.Draw.prototype.getElements = function ()
    {
        return this.editors;
    }

    jsOMS.Modules.Draw.prototype.count = function ()
    {
        return this.editors.length;
    }
}(window.jsOMS = window.jsOMS || {}));

jsOMS.ready(function ()
{
    window.omsApp.moduleManager.initModule('Draw');
    window.omsApp.moduleManager.get('Draw').bind();
});

/**
 * DrawType.
 *
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0 * @since      1.0.0
 */
(function (jsOMS, undefined)
{
    jsOMS.Modules.Draw.DrawTypeEnum = Object.freeze({
        DRAW: 0,
        LINE: 1,
        RECTANGLE: 2,
        CIRCLE: 3,
    });
}(window.jsOMS = window.jsOMS || {}));

(function (jsOMS, undefined)
{
    jsOMS.Modules.Draw.Editor = function (editor)
    {
        this.editor = editor;
        this.canvas = document.getElementsByTagName('canvas')[0];
        this.canvasContainer = this.canvas.parentElement;
        this.ctx = this.canvas.getContext("2d");

        var canvasStyle = window.getComputedStyle(this.canvas, null);
        var canvasContainerStyle = window.getComputedStyle(this.canvasContainer, null);

        this.resize({
            width: parseFloat(canvasContainerStyle.width) - parseFloat(canvasContainerStyle.paddingLeft) - parseFloat(canvasContainerStyle.paddingRight) - parseFloat(canvasContainerStyle.borderLeftWidth) - parseFloat(canvasStyle.borderLeftWidth),
            height: parseFloat(canvasContainerStyle.height) - parseFloat(canvasContainerStyle.paddingTop) - parseFloat(canvasContainerStyle.paddingBottom) - parseFloat(canvasContainerStyle.borderRightWidth) - parseFloat(canvasStyle.borderRightWidth)
        });

        // Backup for undo.
        this.canvasBackup = document.createElement('canvas');
        this.ctxBackup = this.canvasBackup.getContext("2d");

        this.size = 1;
        this.type = jsOMS.Modules.Draw.DrawTypeEnum.RECTANGLE;
        this.color = '#000000';
        this.drawFlag = false;
        this.oldPos = {x: 0, y: 0};
        this.newPos = {x: 0, y: 0};

        // All backup steps need to be stored here (draw, resize etc.)
        // Undo means the whole canvas will be redrawn on the canvasBackup without the last step
        this.undoHistory = [];
        this.redoHistory = [];
    };

    jsOMS.Modules.Draw.Editor.prototype.bind = function ()
    {
        var self = this;

        // Handle draw and resize
        this.canvas.addEventListener('mousemove', function (evt)
        {
            if (!self.drawFlag || self.type === jsOMS.Modules.Draw.DrawTypeEnum.DRAW) {
                self.oldPos = self.newPos;
                self.newPos = self.mousePosition(evt);

                if (self.newPos.x < self.canvas.width - 1 && self.newPos.x > self.canvas.width - 5 && self.newPos.y < self.canvas.height - 1 && self.newPos.y > self.canvas.height - 5) {
                    document.body.style.cursor = 'nwse-resize';
                } else if (self.newPos.x > 1 && self.newPos.x < 5 && self.newPos.y > 1 && self.newPos.y < 5) {
                    document.body.style.cursor = 'nwse-resize';
                } else if (self.newPos.x > 1 && self.newPos.x < 5 && self.newPos.y < self.canvas.height - 1 && self.newPos.y > self.canvas.height - 5) {
                    document.body.style.cursor = 'nesw-resize';
                } else if (self.newPos.x < self.canvas.width - 1 && self.newPos.x > self.canvas.width - 5 && self.newPos.y > 1 && self.newPos.y < 5) {
                    document.body.style.cursor = 'nesw-resize';
                } else if (self.newPos.x < self.canvas.width - 1 && self.newPos.x > self.canvas.width - 5 && self.newPos.y > 5 && self.newPos.y < self.canvas.height - 5) {
                    document.body.style.cursor = 'ew-resize';
                } else if (self.newPos.x > 1 && self.newPos.x < 5 && self.newPos.y > 5 && self.newPos.y < self.canvas.height - 5) {
                    document.body.style.cursor = 'ew-resize';
                } else if (self.newPos.x > 5 && self.newPos.x < self.canvas.width - 5 && self.newPos.y < self.canvas.height - 1 && self.newPos.y > self.canvas.height - 5) {
                    document.body.style.cursor = 'ns-resize';
                } else if (self.newPos.x > 5 && self.newPos.x < self.canvas.width - 5 && self.newPos.y > 1 && self.newPos.y < 5) {
                    document.body.style.cursor = 'ns-resize';
                } else {
                    document.body.style.cursor = 'default';
                }

                if (self.type === jsOMS.Modules.Draw.DrawTypeEnum.DRAW) {
                    self.draw(self.oldPos, self.newPos);
                }
            }
        }, false);

        this.canvas.addEventListener("mousedown", function (evt)
        {
            self.drawFlag = true;
            self.oldPos = self.newPos;
            self.newPos = self.mousePosition(evt);

            if (self.drawFlag && self.type === jsOMS.Modules.Draw.DrawTypeEnum.DRAW) {
                self.draw(self.newPos, self.newPos);
            } else if (self.drawFlag && self.type === jsOMS.Modules.Draw.DrawTypeEnum.RECTANGLE || self.type === jsOMS.Modules.Draw.DrawTypeEnum.LINE || self.type === jsOMS.Modules.Draw.DrawTypeEnum.CIRCLE) {
                self.oldPos = self.newPos;
                self.newPos = self.mousePosition(evt);
            }
        }, false);

        this.canvas.addEventListener("mouseup", function (evt)
        {
            self.oldPos = self.newPos;
            self.newPos = self.mousePosition(evt);

            if (self.drawFlag && self.type === jsOMS.Modules.Draw.DrawTypeEnum.RECTANGLE || self.type === jsOMS.Modules.Draw.DrawTypeEnum.LINE || self.type === jsOMS.Modules.Draw.DrawTypeEnum.CIRCLE) {
                self.draw(self.oldPos, self.newPos);
            }

            self.drawFlag = false;
        }, false);

        this.canvas.addEventListener("mouseout", function (evt)
        {
            self.oldPos = self.newPos;
            self.newPos = self.mousePosition(evt);

            self.draw(self.oldPos, self.newPos);
            self.drawFlag = false;
            document.body.style.cursor = 'default';
        }, false);
    };

    jsOMS.Modules.Draw.Editor.prototype.draw = function (start, end)
    {
        if (this.drawFlag) {
            this.ctx.beginPath();
            this.ctx.strokeStyle = this.color;
            this.ctx.lineWidth = this.size;

            if (this.type === jsOMS.Modules.Draw.DrawTypeEnum.DRAW) {
                this.ctx.moveTo(start.x, start.y);
                this.ctx.lineTo(end.x, end.y);
            } else if (this.type === jsOMS.Modules.Draw.DrawTypeEnum.RECTANGLE) {
                this.ctx.rect(start.x, start.y, end.x - start.x, end.y - start.y);
            } else if (this.type === jsOMS.Modules.Draw.DrawTypeEnum.CIRCLE) {
                this.ctx.arc(start.x, start.y, Math.sqrt((end.x - start.x) * (end.x - start.x) + (end.y - start.y) * (end.y - start.y)), 0, 2 * Math.PI);
            } else if (this.type === jsOMS.Modules.Draw.DrawTypeEnum.LINE) {
                this.ctx.moveTo(start.x, start.y);
                this.ctx.lineTo(end.x, end.y);
            }

            this.ctx.stroke();
            // this.ctx.closePath();

            // check if undo has space
            // create backup to backup canvas
            // remove x first undos from history
            // add this step to undo
        }
    }

    jsOMS.Modules.Draw.Editor.prototype.setSize = function (size)
    {
        this.size = size;
    }

    jsOMS.Modules.Draw.Editor.prototype.setType = function (type)
    {
        this.type = type;
    }

    jsOMS.Modules.Draw.Editor.prototype.setColor = function (color)
    {
        this.color = color;
    }

    jsOMS.Modules.Draw.Editor.prototype.mousePosition = function (evt)
    {
        var rect = this.canvas.getBoundingClientRect();
        return {
            x: evt.clientX - rect.left - 0.5,
            y: evt.clientY - rect.top - 0.5
        };
    }

    jsOMS.Modules.Draw.Editor.prototype.resize = function (size)
    {
        var tmpCanvas = document.createElement('canvas');
        tmpCanvas.width = this.canvas.width;
        tmpCanvas.height = this.canvas.height;

        tmpCanvas.getContext('2d').drawImage(this.canvas, 0, 0);

        this.canvas.width = size.width;
        this.canvas.height = size.height;

        this.canvas.getContext('2d').drawImage(tmpCanvas, 0, 0, tmpCanvas.width, tmpCanvas.height, 0, 0, this.canvas.width, this.canvas.height);
    }

    jsOMS.Modules.Draw.Editor.prototype.scale = function (scale)
    {
        var tmpCanvas = document.createElement('canvas');
        tmpCanvas.width = this.canvas.width;
        tmpCanvas.height = this.canvas.height;

        tmpCanvas.getContext('2d').drawImage(this.canvas, 0, 0);

        this.canvas.getContext('2d').drawImage(tmpCanvas, 0, 0, tmpCanvas.width, tmpCanvas.height, 0, 0, scale.width, scale.height);
    }
}(window.jsOMS = window.jsOMS || {}));