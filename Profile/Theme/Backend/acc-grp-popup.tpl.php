<template id="acc-grp-tpl">
    <section id="acc-grp" class="box w-50" style="z-index: 9; position: absolute; margin: 0 auto; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <header><h1><?= $this->l11n->getText('Profile', 'Account/Group'); ?></h1></header>

        <div class="inner">
            <form id="fAccGrp"  method="GET" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/accgrp'); ?>">
                <table class="layout wf-100">
                    <tbody>
                    <tr><td colspan="2"><label for="iReceiver">Search</label>
                    <tr><td><input type="text" id="iDue" name="due" value=""><td>
                    <tr><td colspan="2">
                        <table class="table">
                            <thead>
                                <tr><th>ID<th>Name<th>Address<th>City<th>Zip<th>Country
                            <tbody>
                            <tfoot>
                        </table>
                    <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->getText(0, 'Search'); ?>"><input type="hidden" name="type" value="<?= \Modules\Tasks\Models\TaskType::SINGLE; ?>">
                </table>
            </form>
        </div>
    </section>
</template>