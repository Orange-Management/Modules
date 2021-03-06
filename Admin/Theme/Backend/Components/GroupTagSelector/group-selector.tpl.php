<div class="ipt-wrap">
    <div class="ipt-first">
        <span class="input">
            <button type="button" id="<?= $this->printHtml($this->getId()); ?>-book-button" data-action='[
                {
                    "key": 1, "listener": "click", "action": [
                        {"key": 1, "type": "dom.popup", "selector": "#group-selector-tpl", "aniIn": "fadeIn", "id": "<?= $this->printHtml($this->getId()); ?>"},
                        {"key": 2, "type": "message.request", "uri": "<?= \phpOMS\Uri\UriFactory::build('{/prefix}admin/group?filter=some&limit=10'); ?>", "method": "GET", "request_type": "json"},
                        {"key": 3, "type": "dom.table.append", "id": "acc-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1},
                        {"key": 4, "type": "message.request", "uri": "<?= \phpOMS\Uri\UriFactory::build('{/prefix}admin/group?filter=some&limit=10'); ?>", "method": "GET", "request_type": "json"},
                        {"key": 5, "type": "dom.table.append", "id": "grp-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1}
                    ]
                }
            ]'><i class="fa fa-book"></i></button>
            <input type="text" list="<?= $this->printHtml($this->getId()); ?>-datalist" id="<?= $this->printHtml($this->getId()); ?>" name="receiver" placeholder="&#xf007; Guest" data-action='[
                {
                    "key": 1, "listener": "keyup", "action": [
                        {"key": 1, "type": "validate.keypress", "pressed": "!13!37!38!39!40"},
                        {"key": 2, "type": "utils.timer", "id": "<?= $this->printHtml($this->getId()); ?>", "delay": 500, "resets": true},
                        {"key": 3, "type": "dom.datalist.clear", "id": "<?= $this->printHtml($this->getId()); ?>-datalist"},
                        {"key": 4, "type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/group?search={#<?= $this->printHtml($this->getId()); ?>}", "method": "GET", "request_type": "json"},
                        {"key": 5, "type": "dom.datalist.append", "id": "<?= $this->printHtml($this->getId()); ?>-datalist", "value": "id", "text": "name"}
                    ]
                },
                {
                    "key": 2, "listener": "keydown", "action" : [
                        {"key": 1, "type": "validate.keypress", "pressed": "13|9"},
                        {"key": 2, "type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/group?search={#<?= $this->printHtml($this->getId()); ?>}", "method": "GET", "request_type": "json"},
                        {"key": 3, "type": "dom.setvalue", "overwrite": true, "selector": "#<?= $this->printHtml($this->getId()); ?>-idlist", "value": "{0/id}", "data": ""},
                        {"key": 4, "type": "dom.setvalue", "overwrite": true, "selector": "#<?= $this->printHtml($this->getId()); ?>-taglist", "value": "<span id=\"<?= $this->printHtml($this->getId()); ?>-taglist-{0/id}\" class=\"tag red\" data-id=\"{0/id}\"><i class=\"fa fa-times\"></i> {0/name}</span>", "data": ""},
                        {"key": 5, "type": "dom.setvalue", "overwrite": true, "selector": "#<?= $this->printHtml($this->getId()); ?>", "value": "", "data": ""}
                    ]
                }
            ]'>
            <datalist id="<?= $this->printHtml($this->getId()); ?>-datalist"></datalist>
            <input type="hidden" id="<?= $this->printHtml($this->getId()); ?>-idlist"<?= $this->isRequired() ? ' required' : ''; ?>>
        </span>
    </div>
    <div class="ipt-second"><button><?= $this->getHtml('Add', '0', '0'); ?></button></div>
</div>
<div class="box taglist" id="<?= $this->printHtml($this->getId()); ?>-taglist" data-action='[
    {
        "key": 1, "listener": "click", "selector": "#<?= $this->printHtml($this->getId()); ?>-taglist span fa", "action": [
            {"key": 1, "type": "dom.getvalue", "base": "self"},
            {"key": 2, "type": "dom.removevalue", "selector": "#<?= $this->printHtml($this->getId()); ?>-idlist", "data": ""},
            {"key": 3, "type": "dom.remove", "base": "self"}
        ]
    }
]'></div>