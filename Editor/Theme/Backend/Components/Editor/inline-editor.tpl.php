<div id="<?= $this->printHtml($this->getId()); ?>" class="tabular m-editor">
    <ul class="tab-links">
        <li><label for="<?= $this->printHtml($this->getId()); ?>-c-tab-1"><?= $this->getHtml('Text', 'Editor'); ?></label>
        <li><label for="<?= $this->printHtml($this->getId()); ?>-c-tab-2"><?= $this->getHtml('Preview', 'Editor'); ?></label>
    </ul>
    <div class="tab-content">
        <input type="radio" id="<?= $this->printHtml($this->getId()); ?>-c-tab-1" name="tabular-1" checked>

        <div class="tab">
            <textarea style="height: 300px" placeholder="&#xf040;" name="<?= $this->printHtml($this->getName()); ?>" form="<?= $this->printHtml($this->getForm()); ?>"><?= $this->printHtml(isset($doc) ? $doc->getPlain() : ''); ?></textarea><input type="hidden" id="<?= $this->printHtml($this->getId()); ?>-parsed">
        </div>
        <input type="radio" id="<?= $this->printHtml($this->getId()); ?>-c-tab-2" name="tabular-1">

        <div class="tab">
            <?= $this->printHtml(isset($doc) ? $doc->getContent() : ''); ?>
        </div>
    </div>
</div>