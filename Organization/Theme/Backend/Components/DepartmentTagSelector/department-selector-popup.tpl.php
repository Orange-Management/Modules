<template id="org-department-selector-tpl">
    <section id="org-department-selector" class="box w-50" style="z-index: 9; position: absolute; margin: 0 auto; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <header><h1><?= $this->getHtml('Department', 'Organization') ?></h1></header>

        <div class="inner">
            <label for="iSearchOrgDepartment">Search</label>
            <input type="text" id="iSearchOrgDepartment" name="receiver-search" data-action='[
                {
                    "key": 1, "listener": "keyup", "action": [
                        {"key": 1, "type": "utils.timer", "id": "iSearchOrgDepartment", "delay": 500, "resets": true},
                        {"key": 2, "type": "dom.table.clear", "id": "acc-table"},
                        {"key": 3, "type": "message.request", "uri": "{/base}/{/lang}/api/organization/find/department?search={#iSearchOrgDepartment}", "method": "GET", "request_type": "json"},
                        {"key": 4, "type": "dom.table.append", "id": "acc-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1}
                    ]
                }
            ]' autocomplete="off">
            <table id="acc-table" class="table">
                <thead>
                    <tr>
                        <th data-name="id">ID
                        <th data-name="name">Name
                        <th data-name="address">Address
                        <th data-name="city">City
                        <th data-name="zip">Zip
                        <th data-name="country">Country
                        <!-- todo: get data from tr in action and pass it to next actions, or make new request based on table cell? -->
                <tbody data-action='[
                    {
                        "key": 1, "listener": "click", "selector": "#acc-table tbody tr", "action": [
                        {"key": 1, "type": "dom.getvalue", "base": "self", "selector": ""},
                        {"key": 2, "type": "dom.setvalue", "overwrite": false, "selector": "#{$id}-idlist", "value": "{0/id}", "data": ""},
                        {"key": 3, "type": "dom.setvalue", "overwrite": false, "selector": "#{$id}-taglist", "value": "<span id=\"{$id}-taglist-{0/id}\" class=\"tag red\" data-id=\"{0/id}\"><i class=\"fa fa-times\"></i> {0/name/0}, {0/name/1}<span>", "data": ""},
                        {"key": 4, "type": "dom.setvalue", "overwrite": true, "selector": "#{$id}", "value": "", "data": ""}
                        ]
                    }
                ]'>
                <tfoot>
            </table>
            <button type="button" id="iSearchOrgDepartment-close" data-action='[
                    {
                        "key": 1, "listener": "click", "action": [
                            {"key": 1, "type": "dom.remove", "selector": "#org-department-selector", "aniOut": "fadeOut"}
                        ]
                    }
                ]'><?= $this->getHtml('Close', 'Admin') ?></button>
        </div>
    </section>
</template>