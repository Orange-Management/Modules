<span class="input">
<button type="button" data-action='[
    {
        "listener": "click", "action": [
            {"key": 1, "type": "dom.popup", "tpl": "acc-grp-tpl", "aniIn": "fadeIn"},
            {"key": 2, "type": "message.request", "uri": "<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/account?filter=some&limit=10'); ?>", "method": "GET", "request_type": "json"},
            {"key": 3, "type": "dom.table.append", "id": "acc-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1},
            {"key": 4, "type": "message.request", "uri": "<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/account?filter=some&limit=10'); ?>", "method": "GET", "request_type": "json"},
            {"key": 5, "type": "dom.table.append", "id": "grp-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1}
        ]
    }
]' formaction=""><i class="fa fa-book"></i></button>
<input type="text" list="<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>-datalist" id="<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>" name="receiver" placeholder="&#xf007; Guest" data-action='[
    {
        "key": 1, "listener": "keyup", "action": [
            {"key": 1, "type": "validate.keypress", "pressed": "!13"},
            {"key": 2, "type": "utils.timer", "id": "<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>", "delay": 500, "resets": true},
            {"key": 3, "type": "dom.datalist.clear", "id": "<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>-datalist"},
            {"key": 4, "type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/account?search={#<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>}", "method": "GET", "request_type": "json"},
            {"key": 5, "type": "dom.datalist.append", "id": "<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>-datalist", "value": "id", "text": "name"}
        ]
    },
    {
        "key": 2, "listener": "keydown", "action" : [
            {"key": 1, "type": "validate.keypress", "pressed": "13"},
            {"key": 2, "type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/account?search={#<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>}", "method": "GET", "request_type": "json"},
            {"key": 3, "type": "dom.setvalue", "overwrite": false, "id": "<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>-idlist", "data-path": "", "data": ""},
            {"key": 4, "type": "dom.setvalue", "overwrite": false, "id": "<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>-taglist", "data-path": "", "data": ""}
        ]
    }
]' required><!-- todo: handle keyup-enter -->
<datalist id="<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>-datalist"></datalist>
<input type="hidden" id="<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>-idlist"></span>
<div id="<?= htmlspecialchars($this->getId(), ENT_COMPAT, 'utf-8'); ?>-taglist"></div>