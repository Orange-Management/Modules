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
<input type="text" list="<?= $this->getId(); ?>-datalist" id="<?= $this->getId(); ?>" name="receiver" placeholder="&#xf007; Guest" data-action='[
    {
        "listener": "keyup", "action": [
            {"key": 1, "type": "utils.timer", "id": "<?= $this->getId(); ?>", "delay": 500, "resets": true},
            {"key": 2, "type": "dom.datalist.clear", "id": "<?= $this->getId(); ?>-datalist"},
            {"key": 3, "type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/account?search={#<?= $this->getId(); ?>}", "method": "GET", "request_type": "json"},
            {"key": 4, "type": "dom.datalist.append", "id": "<?= $this->getId(); ?>-datalist", "value": "id", "text": "name"}
        ]
    }
]' required>
<datalist id="<?= $this->getId(); ?>-datalist"></datalist>
<input type="hidden" id="<?= $this->getId(); ?>-list"></span>
<input data-action='[
    {
        "listener": "keyup", "action": [
            {"key": 1, "type": "utils.timer", "id": "<?= $this->getId(); ?>", "delay": 500, "resets": true},
            {"key": 2, "type": "dom.datalist.clear", "id": "<?= $this->getId(); ?>-datalist"},
            {"key": 2, "type": "dom.class.add", "id": "<?= $this->getId(); ?>-datalist", "class": "hidden"},
            {"key": 3, "type": "utils.validate", "id": "<?= $this->getId(); ?>-datalist", "pattern": ""},
            {"key": 4, "type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/account?search={#<?= $this->getId(); ?>}", "method": "GET", "request_type": "json"},
            {"key": 5, "type": "dom.set", "id": "", "data": ""},
            {"key": 6, "type": "dom.add", "id": "asfdsaf", "data": [], "schema": "<li data-value=\"{$value}\">{$text}", "position": "end"},
            {"key": 7, "type": "dom.unbind", "id": "asfdsaf"},
            {"key": 8, "type": "dom.bind", "id": "asfdsaf"},
            {"key": 2, "type": "dom.class.remove", "id": "<?= $this->getId(); ?>-datalist", "class": "hidden"}
        ]
    }
]'>
<!--
<ul class="select" data-action='[
    {
        "listener": "click", "selector": "ul.select li" "action": [
            {"key": 1, "type": "dom.add", "id": "taglist", "schema": "<span data-value=\"{$value}\">{$text}</span>", "position": "end"},
            {"key": 2, "type": "dom.bind", "id": "asfdsaf"}
        ]
    }
]'>
    <li data-value="my value">Text
</ul>
-->
<div id="tag-list"></div>