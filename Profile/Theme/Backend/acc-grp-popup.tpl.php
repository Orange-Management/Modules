<template id="acc-grp-tpl">
    <section id="acc-grp" class="box w-50" style="z-index: 9; position: absolute; margin: 0 auto; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <header><h1><?= $this->getText('Account/Group', 'Admin'); ?></h1></header>

        <div class="inner">
            <form id="fAccGrp"  method="GET" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/accgrp'); ?>">
                <table class="layout wf-100">
                    <tbody>
                    <tr><td colspan="2"><label for="iReceiverSearch">Search</label>
                    <tr><td><input type="text" id="iReceiverSearch" name="receiver-search" data-action='[
                        {
                            "listener": "keyup", "action": [
                                {"type": "utils.timer", "id": "iReceiverSearch", "delay": 500, "resets": true},
                                {"type": "dom.table.clear", "id": "acc-grp-table"},
                                {"type": "message.request", "uri": "{/base}/{/lang}/api/admin/find/account?search={#iReceiverSearch}", "method": "GET", "request_type": "json"},
                                {"type": "dom.table.append", "id": "acc-grp-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1}
                            ]
                        }
                    ]' autocomplete="off"><td>
                    <tr><td colspan="2">
                        <table id="acc-grp-table" class="table">
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
                                    {"type": "dom.remove", "tpl": "acc-grp", "aniOut": "fadeOut"}
                                ]
                            }
                        ]'><?= $this->getText('Close', 'Admin'); ?></button>
                </table>
            </form>
        </div>
    </section>
</template>