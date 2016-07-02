<template id="entry-list-tpl">
    <div id="entry-list" class="box" style="z-index: 99; position: relative; top: 20px; display: block; margin: 0 auto; width: 20%;">
        <table class="table">
            <caption><?= $this->l11n->getText('Accounting', 'Accounts'); ?></caption>
            <thead>
            <tr>
                <td><?= $this->l11n->getText(0, 'ID'); ?>
                <td class="wf-100"><?= $this->l11n->getText('Accounting', 'Account'); ?>
            <tbody>
        </table>
    </div>
</template>