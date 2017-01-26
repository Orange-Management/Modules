(function (jsOMS)
    {
        "use strict";

        jsOMS.Modules.Editor.Editor = function (editor)
        {

        };

        jsOMS.Modules.Editor.prototype.getSelectedText = function()
        {
            var text            = '';
            var activeEl        = document.activeElement;
            var activeElTagName = activeEl ? activeEl.tagName.toLowerCase() : null;
            if (
                (activeElTagName === 'textarea' || activeElTagName === 'input') &&
                /^(?:text|search|password|tel|url)$/i.test(activeEl.type) &&
                (typeof activeEl.selectionStart === 'number')
            ) {
                text = activeEl.value.slice(activeEl.selectionStart, activeEl.selectionEnd);
            } else if (window.getSelection) {
                text = window.getSelection().toString();
            }
            return text;
        };

    }(window.jsOMS = window.jsOMS || {})
);