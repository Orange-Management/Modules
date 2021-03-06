<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Editor
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View                 $this
 * @var \Modules\Editor\Models\EditorDoc[] $docs
 */
$docs = $this->getData('docs');

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Documents') ?><i class="fa fa-download floatRight download btn"></i></div>
            <table class="default">
            <thead>
            <tr>
                <td class="wf-100"><?= $this->getHtml('Title') ?>
                <td><?= $this->getHtml('Creator') ?>
                <td><?= $this->getHtml('Created') ?>
            <tbody>
            <?php $count = 0; foreach ($docs as $key => $value) : ++$count;
            $url = \phpOMS\Uri\UriFactory::build('{/prefix}editor/single?{?}&id=' . $value->getId()); ?>
                <tr data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('Title') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getTitle()); ?></a>
                    <td data-label="<?= $this->getHtml('Creator') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedBy()->getName1()); ?></a>
                    <td data-label="<?= $this->getHtml('Created') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedAt()->format('Y-m-d H:i:s')); ?></a>
            <?php endforeach; ?>
            <?php if ($count === 0) : ?>
                <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
            <?php endif; ?>
        </table>
        <div class="portlet-foot"></div>
    </div>
</div>
