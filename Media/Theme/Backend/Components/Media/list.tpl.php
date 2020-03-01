<?php declare(strict_types=1);
use phpOMS\System\File\ExtensionType;
use phpOMS\System\File\FileUtils;
use phpOMS\Uri\UriFactory;

?>
<div class="portlet">
    <div class="portlet-head"><?= $this->getHtml('Media', 'Media') ?><i class="fa fa-download floatRight download btn"></i></div>
    <table class="default">
        <thead>
            <td>
            <td class="wf-100"><?= $this->getHtml('Name', 'Media') ?>
            <td><?= $this->getHtml('Type', 'Media') ?>
            <td><?= $this->getHtml('Size', 'Media') ?>
            <td><?= $this->getHtml('Creator', 'Media') ?>
            <td><?= $this->getHtml('Created', 'Media') ?>
        <tbody>
            <?php $count = 0; foreach ($this->media as $key => $value) : ++$count;
                $url = UriFactory::build('{/prefix}media/single?{?}&id=' . $value->getId());

                $icon = '';
                $extensionType = FileUtils::getExtensionType($value->getExtension());

                if ($extensionType === ExtensionType::CODE) {
                    $icon = 'file-code-o';
                } elseif ($extensionType === ExtensionType::TEXT) {
                    $icon = 'file-text-o';
                } elseif ($extensionType === ExtensionType::PRESENTATION) {
                   $icon = 'file-powerpoint-o';
                } elseif ($extensionType === ExtensionType::PDF) {
                    $icon = 'file-pdf-o';
                } elseif ($extensionType === ExtensionType::ARCHIVE) {
                    $icon = 'file-zip-o';
                } elseif ($extensionType === ExtensionType::AUDIO) {
                    $icon = 'file-audio-o';
                } elseif ($extensionType === ExtensionType::VIDEO) {
                    $icon = 'file-video-o';
                } elseif ($extensionType === ExtensionType::IMAGE) {
                    $icon = 'file-image-o';
                } elseif ($extensionType === ExtensionType::SPREADSHEET) {
                    $icon = 'file-excel-o';
                } elseif ($value->getExtension() === 'collection') {
                    $icon = 'folder-open-o';
                } else {
                    $icon = 'file-o';
                }
        ?>
        <tr data-href="<?= $url; ?>">
            <td data-label="<?= $this->getHtml('Type') ?>"><a href="<?= $url; ?>"><i class="fa fa-<?= $this->printHtml($icon); ?>"></i></a>
            <td data-label="<?= $this->getHtml('Name') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
            <td data-label="<?= $this->getHtml('Extension') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getExtension()); ?></a>
            <td data-label="<?= $this->getHtml('Size') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getSize()); ?></a>
            <td data-label="<?= $this->getHtml('Creator') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedBy()->getName1()); ?></a>
            <td data-label="<?= $this->getHtml('Created') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedAt()->format('Y-m-d H:i:s')); ?></a>
        <?php endforeach; ?>
        <?php if ($count === 0) : ?>
        <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
        <?php endif; ?>
    </table>
    <div class="portlet-foot"></div>
</div>