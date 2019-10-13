import { Markdown } from '../../../jsOMS/Utils/Parser/Markdown.js';

export class Editor {
    constructor (id)
    {
        this.id       = id;
        this.editor   = document.getElementById(id);
        this.markdown = new Markdown.Converter({extensions: [], sanitize: true});
        this.editorContent = null;
    };

    bind ()
    {
        const editorButtons = document.querySelectorAll('#' + this.id + '-tools .editor-button');
        const editorPreview = this.editor.getElementsByTagName('article')[0];
        const length        = editorButtons.length;
        const self          = this;

        this.editorContent = this.editor.getElementsByTagName('textarea')[0];

        for (let i = 0; i < length; ++i) {
            editorButtons[i].addEventListener('click', function(event) {
                // todo: identify button by class and then call function for this class.
                self.toolsButton(this, event);
                jsOMS.triggerEvent(self.editorContent, 'input');
            });
        }

        this.editorContent.addEventListener('input', function() {
            editorPreview.innerHTML = self.markdown.makeHtml(self.editorContent.value);
        })
    };

    toolsButton (e, event)
    {
        let textarea = this.editor.getElementsByTagName('textarea')[0];

        const startPosition = textarea.selectionStart;
        let endPosition     = textarea.selectionEnd;
        let startOffset     = 0;
        let endOffset       = 0;
        let lines           = [];
        let linesLength     = 0;
        let end             = '';

        switch (e.dataset['editorButton']) {
            case 'undo':

                break;
            case 'redo':

                break;
            case 'bold':
                startOffset = 2;
                endOffset   = 2;
                textarea.value = textarea.value.slice(0, startPosition)
                    + '**' + textarea.value.slice(startPosition, endPosition) + '**'
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'italic':
                startOffset = 1;
                endOffset   = 1;
                textarea.value = textarea.value.slice(0, startPosition)
                    + '*' + textarea.value.slice(startPosition, endPosition) + '*'
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'underline':
                startOffset = 2;
                endOffset   = 2;
                textarea.value = textarea.value.slice(0, startPosition)
                    + '__' + textarea.value.slice(startPosition, endPosition) + '__'
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'strikethrough':
                startOffset = 2;
                endOffset   = 2;
                textarea.value = textarea.value.slice(0, startPosition)
                    + '~~' + textarea.value.slice(startPosition, endPosition) + '~~'
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'ulist':
                lines       = textarea.value.slice(startPosition, endPosition).split("\n");
                linesLength = lines.length;

                textarea.value = textarea.value.slice(0, startPosition);
                end            = textarea.value.slice(endPosition, textarea.value.length);

                for (let i = 0; i < linesLength; ++i) {
                    textarea.value += '    * ' + lines[i] + "\n";
                }

                endPosition     = startPosition;
                textarea.value += end;
                break;
            case 'olist':
                lines       = textarea.value.slice(startPosition, endPosition).split("\n");
                linesLength = lines.length;

                textarea.value = textarea.value.slice(0, startPosition);
                end            = textarea.value.slice(endPosition, textarea.value.length);

                for (let i = 0; i < linesLength; ++i) {
                    textarea.value += '    ' + (i + 1) + '. ' + lines[i] + "\n";
                }

                endPosition     = startPosition;
                textarea.value += end;
                break;
            case 'indent':
                lines       = textarea.value.slice(startPosition, endPosition).split("\n");
                linesLength = lines.length;

                textarea.value = textarea.value.slice(0, startPosition);
                end            = textarea.value.slice(endPosition, textarea.value.length);

                for (let i = 0; i < linesLength; ++i) {
                    textarea.value += '    ' + lines[i] + "\n";
                }

                endPosition     = startPosition;
                textarea.value += end;
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
                startOffset = 1;
                endOffset   = 0;
                let link = textarea.value.slice(startPosition, endPosition);

                textarea.value = textarea.value.slice(0, startPosition)
                    + ((link.startsWith('http') || link.startsWith('www')) ? '[' + link + ']' : '[' + link + '](https://www.website.com "' + link + '")')
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'code':
                startOffset = 1;
                endOffset   = 1;
                textarea.value = textarea.value.slice(0, startPosition)
                    + '`' + textarea.value.slice(startPosition, endPosition) + '`'
                    + textarea.value.slice(endPosition, textarea.value.length);
                break;
            case 'quote':
                startOffset = 2;
                endOffset   = 0;
                textarea.value = textarea.value.slice(0, startPosition)
                    + '> ' + textarea.value.slice(startPosition, textarea.value.length);
                break;
            default:
                break;
        }

        textarea.focus();
        textarea.setSelectionRange(startPosition + startOffset, endPosition + startOffset);
    };

    getSelectedText ()
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
};