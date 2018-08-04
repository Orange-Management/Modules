(function (jsOMS)
{
    "use strict";

    jsOMS.Autoloader.defineNamespace('jsOMS.Modules.Models.Editor');

    jsOMS.Modules.Models.Editor.Editor = function (id)
    {
        this.id     = id;
        this.editor = document.getElementById(id);
    };

    jsOMS.Modules.Models.Editor.Editor.prototype.bind = function()
    {
        const editorButtons = document.querySelectorAll('#' + this.id + '-tools .editor-button'),
            editorTitle     = this.editor.getElementsByClassName('editor-title')[0],
            editorContent   = this.editor.getElementsByClassName('editor-content')[0],
            editorPreview   = this.editor.getElementsByClassName('editor-preview')[0],
            length          = editorButtons.length,
            self            = this;

        for(let i = 0; i < length; ++i) {
            editorButtons[i].addEventListener('click', function(event) {
                // todo: identify button by class and then call function for this class.
                self.toolsButton(this, event);
            });
        }
    };

    jsOMS.Modules.Models.Editor.Editor.prototype.toolsButton = function (e, event)
    {
        let textarea = this.editor.getElementsByTagName('textarea')[0];

        const startPosition = textarea.selectionStart,
            endPosition = textarea.selectionEnd;

        switch (e.dataset['editorButton']) {
            case 'undo':

                break;
            case 'redo':

                break;
            case 'bold':
                textarea.value = textarea.value.slice(0, startPosition)
                    + '**' + textarea.value.slice(startPosition, endPosition) + '**'
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'italic':
                textarea.value = textarea.value.slice(0, startPosition)
                    + '*' + textarea.value.slice(startPosition, endPosition) + '*'
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'underline':
                textarea.value = textarea.value.slice(0, startPosition)
                    + '__' + textarea.value.slice(startPosition, endPosition) + '__'
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'strikethrough':
                textarea.value = textarea.value.slice(0, startPosition)
                    + '~~' + textarea.value.slice(startPosition, endPosition) + '~~'
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'ulist':
                textarea.value = textarea.value.slice(0, startPosition) + "\n"
                    + '    * ' + textarea.value.slice(startPosition, endPosition)
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'olist':
                textarea.value = textarea.value.slice(0, startPosition) + "\n"
                    + '    1. ' + textarea.value.slice(startPosition, endPosition)
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'indent':
                textarea.value = textarea.value.slice(0, startPosition)
                    + '    ' + textarea.value.slice(startPosition, endPosition)
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'table':
                textarea.value = textarea.value.slice(0, startPosition) + "\n"
                    + '| Tables        | Are               | Cool  |' + "\n"
                    + '| ------------- |:-----------------:| -----:|' + "\n"
                    + '| col 3 is      | right - aligned   | $1600 |' + "\n"
                    + '| col 2 is      | centered          | $12   |' + "\n"
                    + '| zebra stripes | are neat          | $1    |' + "\n"
                    + textarea.value.slice(startPosition, textarea.value.length);
                break;
            case 'link':
                let link = textarea.value.slice(startPosition, endPosition);

                textarea.value = textarea.value.slice(0, startPosition)
                    + ((link.startsWith('http') || link.startsWith('www')) ? '[' + link + ']' : '[' + link + '](https://www.website.com "' + link + '")')
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'code':
                textarea.value = textarea.value.slice(0, startPosition)
                    + '`' + textarea.value.slice(startPosition, endPosition) + '`'
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'quote':
                textarea.value = textarea.value.slice(0, startPosition) + "\n"
                    + '> ' + textarea.value.slice(startPosition, textarea.value.length);
                break;
            default:
                break;
        }

        textarea.focus();
        textarea.setSelectionRange(endPosition, endPosition);
    };

    jsOMS.Modules.Models.Editor.Editor.prototype.getSelectedText = function()
    {
        let text              = '';
        const activeEl        = document.activeElement;
        const activeElTagName = activeEl ? activeEl.tagName.toLowerCase() : null;

        if ((activeElTagName === 'textarea' || activeElTagName === 'input')
            && /^(?:text|search|password|tel|url)$/i.test(activeEl.type)
            && (typeof activeEl.selectionStart === 'number')
        ) {
            text = activeEl.value.slice(activeEl.selectionStart, activeEl.selectionEnd);
        } else if (window.getSelection) {
            text = window.getSelection().toString();
        }

        return text;
    };
}(window.jsOMS = window.jsOMS || {}));