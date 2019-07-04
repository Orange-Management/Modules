<div class="ipt-wrap">
    <div class="ipt-first">
        <span class="input">
            <div class="advancedSelect" id="<?= $this->printHtml($this->getId()); ?>"
                    data-search="true"
                    data-multiple="false"
                    data-src="api/admin/find/accgrp?search={#i<?= $this->printHtml($this->getId()); ?>}">
                <template><!-- Template for the selected element --></template>
            </div>
            <div id="<?= $this->printHtml($this->getId()); ?>-dropdown" class="dropdown" data-active="true" data-selected="<?= $task->getStatus(); ?>">
                <template class="rowTemplate"><!-- Template for remote data or data manually to be added --></template>
                <tr><td data-value="<?= TaskStatus::OPEN; ?>"><?= $this->getHtml('S1') ?>
                <tr><td data-value="<?= TaskStatus::WORKING; ?>"><?= $this->getHtml('S2') ?>
                <tr><td data-value="<?= TaskStatus::SUSPENDED; ?>"><?= $this->getHtml('S3') ?>
                <tr><td data-value="<?= TaskStatus::CANCELED; ?>"><?= $this->getHtml('S4') ?>
                <tr><td data-value="<?= TaskStatus::DONE; ?>"><?= $this->getHtml('S5') ?>
            </div>
        </span>
    </div>
</div>