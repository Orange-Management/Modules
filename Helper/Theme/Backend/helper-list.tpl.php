<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Helper
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View                $this
 * @var \Modules\Helper\Models\Template[] $templates
 */
$templates = $this->getData('reports');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Helpers') ?><i class="fa fa-download floatRight download btn"></i></div>
            <table class="default">
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
                    <td><?= $this->getHtml('Creator') ?>
                    <td><?= $this->getHtml('Updated') ?>
                <tbody>
                <?php if (\count($templates) == 0) : ?>
                <tr class="empty">
                    <td colspan="4"><?= $this->getHtml('Empty', '0', '0'); ?>
                        <?php endif; ?>
                        <?php foreach ($templates as $key => $template) :
                        $url = \phpOMS\Uri\UriFactory::build('{/prefix}helper/report/view?{?}&id=' . $template->getId()); ?>
                <tr data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('ID', '0', '0') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($template->getId()); ?></a>
                    <td data-label="<?= $this->getHtml('Name') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($template->getName()); ?></a>
                    <td data-label="<?= $this->getHtml('Creator') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($template->getCreatedBy()->getName1()); ?></a>
                    <td data-label="<?= $this->getHtml('Updated') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($template->getCreatedAt()->format('Y-m-d')); ?></a>
                        <?php endforeach; ?>
            </table>
            <div class="portlet-foot"></div>
        </div>
    </div>
</div>
