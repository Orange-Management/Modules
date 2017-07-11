<template id="acc-grp-tpl">
    <section id="acc-grp" class="box w-50" style="z-index: 9; position: absolute; margin: 0 auto; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <header><h1><?= $this->getText('Account/Group', 'Admin'); ?></h1></header>

        <div class="inner">
        <div class="tabular-2">
            <div class="box wf-100">
                <ul class="tab-links">
                    <li><label for="c-tab-1"><?= $this->getText('Account', 'Admin'); ?></label>
                    <li><label for="c-tab-2"><?= $this->getText('Group', 'Admin'); ?></label>
                </ul>
            </div>
            <div class="tab-content">
                <input type="radio" id="c-tab-1" name="tabular-2" checked>
                <div class="tab">
                    <form id="fAccSelector"  method="GET" action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/accgrp'); ?>">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td colspan="2"><label for="iSearchAcc">Search</label>
                            <tr><td><input type="text" id="iSearchAcc" name="receiver-search" data-action='[
                                {
                                    "listener": "keyup", "action": [
                                        {"key": 1, "type": "utils.timer", "id": "iSearchAcc", "delay": 500, "resets": true},
                                        {"key": 2, "type": "dom.table.clear", "id": "acc-table"},
                                        {"key": 3, "type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/account?search={#iSearchAcc}", "method": "GET", "request_type": "json"},
                                        {"key": 4, "type": "dom.table.append", "id": "acc-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1}
                                    ]
                                }
                            ]' autocomplete="off"><td>
                            <tr><td colspan="2">
                                <table id="acc-table" class="table">
                                    <thead>
                                        <tr>
                                            <th data-name="id">ID
                                            <th data-name="name">Name
                                            <th data-name="address">Address
                                            <th data-name="city">City
                                            <th data-name="zip">Zip
                                            <th data-name="country">Country
                                    <tbody>
                                    <tfoot>
                                </table>
                            <tr><td colspan="2"><button type="button" data-action='[
                                    {
                                        "listener": "click", "action": [
                                            {"key": 1, "type": "dom.remove", "tpl": "acc-grp", "aniOut": "fadeOut"}
                                        ]
                                    }
                                ]'><?= $this->getText('Close', 'Admin'); ?></button>
                        </table>
                    </form>
                </div>
                <input type="radio" id="c-tab-2" name="tabular-2">
                <div class="tab">
                <form id="fGrpSelector"  method="GET" action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/admin/accgrp'); ?>">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td colspan="2"><label for="iSearchGrp">Search</label>
                            <tr><td><input type="text" id="iSearchGrp" name="receiver-search" data-action='[
                                {
                                    "listener": "keyup", "action": [
                                        {"key": 1, "type": "utils.timer", "id": "iSearchGrp", "delay": 500, "resets": true},
                                        {"key": 2, "type": "dom.table.clear", "id": "grp-table"},
                                        {"key": 3, "type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/account?search={#iSearchGrp}", "method": "GET", "request_type": "json"},
                                        {"key": 4, "type": "dom.table.append", "id": "grp-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1}
                                    ]
                                }
                            ]' autocomplete="off"><td>
                            <tr><td colspan="2">
                                <table id="grp-table" class="table">
                                    <thead>
                                        <tr>
                                            <th data-name="id">ID
                                            <th data-name="name">Name
                                            <th data-name="parent">Parent
                                    <tbody>
                                    <tfoot>
                                </table>
                            <tr><td colspan="2"><button type="button" data-action='[
                                    {
                                        "listener": "click", "action": [
                                            {"key": 1, "type": "dom.remove", "tpl": "acc-grp", "aniOut": "fadeOut"}
                                        ]
                                    }
                                ]'><?= $this->getText('Close', 'Admin'); ?></button>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>