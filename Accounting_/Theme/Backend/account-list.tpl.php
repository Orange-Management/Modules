<template id="entry-list-tpl">
    <div id="entry-list" class="box" style="z-index: 99; position: relative; top: 20px; display: block; margin: 0 auto; width: 20%;">
        <table class="table">
            <caption><?= $this->getText('Accounts'); ?></caption>
            <thead>
            <tr>
                <td><?= $this->getText('ID', 0, 0); ?>
                <td class="wf-100"><?= $this->getText('Account'); ?>
            <tbody>
        </table>
    </div>
</template>