<span class="input">
<button type="button" data-action='[
    {
        "listener": "click", "action": [
            {"type": "dom.popup", "tpl": "acc-grp-tpl", "aniIn": "fadeIn"},
            {"type": "message.request", "uri": "<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/account?filter=some&limit=10'); ?>", "method": "GET", "request_type": "json"},
            {"type": "dom.table.append", "id": "acc-grp-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1}
        ]
    }
]' formaction=""><i class="fa fa-book"></i></button>
<input type="text" list="<?= $this->getId(); ?>-datalist" id="<?= $this->getId(); ?>" name="receiver" placeholder="&#xf007; Guest" data-action='[
    {
        "listener": "keyup", "action": [
            {"type": "utils.timer", "id": "<?= $this->getId(); ?>", "delay": 500, "resets": true},
            {"type": "dom.datalist.clear", "id": "<?= $this->getId(); ?>-datalist"},
            {"type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/account?search={#<?= $this->getId(); ?>}", "method": "GET", "request_type": "json"},
            {"type": "dom.datalist.append", "id": "<?= $this->getId(); ?>-datalist", "value": "id", "text": "name"}
        ]
    }
]' required>
<datalist id="<?= $this->getId(); ?>-datalist"></datalist>
<input type="hidden" id="<?= $this->getId(); ?>-list"></span>