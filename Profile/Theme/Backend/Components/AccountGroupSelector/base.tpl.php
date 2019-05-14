<div class="ipt-wrap">
    <div class="ipt-first">
        <span class="input">
            <button type="button" id="<?= $this->printHtml($this->getId()); ?>-book-button" data-action='[
                {
                    "key": 1, "listener": "click", "action": [
                        {"key": 1, "type": "dom.popup", "selector": "#acc-grp-tpl", "aniIn": "fadeIn", "id": "<?= $this->printHtml($this->getId()); ?>"},
                        {"key": 2, "type": "message.request", "uri": "<?= \phpOMS\Uri\UriFactory::build('{/prefix}admin/account?filter=some&limit=10'); ?>", "method": "GET", "request_type": "json"},
                        {"key": 3, "type": "dom.table.append", "id": "acc-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1},
                        {"key": 4, "type": "message.request", "uri": "<?= \phpOMS\Uri\UriFactory::build('{/prefix}admin/account?filter=some&limit=10'); ?>", "method": "GET", "request_type": "json"},
                        {"key": 5, "type": "dom.table.append", "id": "grp-table", "aniIn": "fadeIn", "data": [], "bindings": {"id": "id", "name": "name/0"}, "position": -1}
                    ]
                }
            ]' formaction=""><i class="fa fa-book"></i></button>
            <div class="advancedInput wf-100" id="<?= $this->printHtml($this->getId()); ?>">
                <input autocomplete="off" class="input" type="text" id="i<?= $this->printHtml($this->getId()); ?>" placeholder="&#xf007; Guest"
                    data-emptyAfter="true"
                    data-autocomplete="false"
                    data-src="api/admin/find/accgrp?search={#i<?= $this->printHtml($this->getId()); ?>}">
                <div id="<?= $this->printHtml($this->getId()); ?>-dropdown" class="dropdown" data-active="true">
                    <table class="default">
                        <thead>
                            <tr>
                                <td>Type<i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td>ID<i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td>Name<i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                                <td>Email<i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                        <tbody>
                            <template id="<?= $this->printHtml($this->getId()); ?>-rowElement" class="rowTemplate">
                                <tr tabindex="-1">
                                    <td data-tpl-text="/type_name" data-tpl-value="/type_prefix" data-value="">
                                    <td data-tpl-text="/id" data-tpl-value="/id" data-value=""></td>
                                    <td data-tpl-text="/name/0" data-tpl-value="/name/0" data-value=""></td>
                                    <td data-tpl-text="/email" data-tpl-value="/email" data-value=""></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </span>
    </div>
    <div class="ipt-second"><button><?= $this->getHtml('Select', '0', '0'); ?></button></div>
</div>
<div class="box" id="<?= $this->printHtml($this->getId()); ?>-tags" data-limit="0" data-active="true">
    <template id="<?= $this->printHtml($this->getId()); ?>-tagTemplate">
        <span class="tag red" data-tpl-value="/id" data-value="" data-uuid="" data-name="<?= $this->printHtml($this->getName()); ?>">
            <i class="fa fa-times"></i>
            <span style="display: none;" data-name="type_prefix" data-tpl-value="/type_prefix" data-value=""></span>
            <span data-tpl-text="/id" data-name="id" data-tpl-value="/id" data-value=""></span>
            <span data-tpl-text="/name/0" data-tpl-value="/name/0" data-value=""></span>
        </span>
    </template>
</div>