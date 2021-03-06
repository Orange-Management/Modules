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
 * @var \phpOMS\Views\View        $this
 * @var \Modules\Tag\Models\Tag[] $tags
 */
$tags = $this->getData('tags');

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Tags') ?><i class="fa fa-download floatRight download btn"></i></div>
            <table class="default">
            <thead>
            <tr>
                <td class="wf-100"><?= $this->getHtml('Title') ?>
                <td class="wf-100"><?= $this->getHtml('Color') ?>
            <tbody>
            <?php $count = 0; foreach ($tags as $key => $value) : ++$count;
            $url = \phpOMS\Uri\UriFactory::build('{/prefix}tag/single?{?}&id=' . $value->getId()); ?>
                <tr data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('Title') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getTitle()); ?></a>
                    <td data-label="<?= $this->getHtml('Title') ?>"><a href="<?= $url; ?>"><span class="tag" style="background: <?= $this->printHtml($value->getColor()); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
            <?php endforeach; ?>
            <?php if ($count === 0) : ?>
                <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
            <?php endif; ?>
        </table>
        <div class="portlet-foot"></div>
    </div>
</div>
