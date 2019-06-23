<div class="ipt-wrap">
    <div class="ipt-first">
        <span class="input">
            <div class="advancedSelect" id="<?= $this->printHtml($this->getId()); ?>"
                    data-search="true"
                    data-multiple="false"
                    data-src="api/admin/find/accgrp?search={#i<?= $this->printHtml($this->getId()); ?>}">
                <template><!-- Template for the selected element --></template>
            </div>
            <div id="<?= $this->printHtml($this->getId()); ?>-dropdown" class="dropdown" data-active="true">
                <template class="rowTemplate"><!-- Template for remote data or data manually to be added --></template>
            </div>
        </span>
    </div>
</div>