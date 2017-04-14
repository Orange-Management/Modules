<template id="acc-grp-tpl">
    <section id="acc-grp" class="box w-50" style="z-index: 9; position: absolute; margin: 0 auto; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <header><h1><?= $this->getText('Account/Group'); ?></h1></header>

        <div class="inner">
            <form id="fAccGrp"  method="GET" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/accgrp'); ?>">
                <table class="layout wf-100">
                    <tbody>
                    <tr><td colspan="2"><label for="iReceiver">Search</label>
                    <tr><td><input type="text" id="iDue" name="due" value=""><td>
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
                    <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Search'); ?>"><input type="hidden" name="type" value="<?= \Modules\Tasks\Models\TaskType::SINGLE; ?>">
                </table>
            </form>
        </div>
    </section>
</template>