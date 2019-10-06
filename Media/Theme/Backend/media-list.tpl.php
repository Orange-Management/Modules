<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Media
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);


include __DIR__ . '/template-functions.php';

/**
 * @var \phpOMS\Views\View $this
 */

$media = $this->getData('media');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table id="mediaList" class="default">
                <caption><?= $this->getHtml('Media') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
                    <td><?= $this->getHtml('Type') ?>
                    <td><?= $this->getHtml('Size') ?>
                    <td><?= $this->getHtml('Creator') ?>
                    <td><?= $this->getHtml('Created') ?>
                <tbody>
                    <?php $count = 0;
                        foreach ($media as $key => $value) :
                            ++$count;
                            $url  = \phpOMS\Uri\UriFactory::build('{/prefix}media/single?{?}&id=' . $value->getId());
                            $icon = $fileIconFunction(\phpOMS\System\File\FileUtils::getExtensionType($value->getExtension()));
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
        </div>
    </div>
</div>
