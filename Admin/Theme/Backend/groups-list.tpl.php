<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Admin\Template\Backend
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);


/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Groups') ?><i class="fa fa-download floatRight download btn"></i></div>
            <table id="groupList" class="default">
                <thead>
                    <tr>
                        <td><?= $this->getHtml('ID', '0', '0'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                        <td><?= $this->getHtml('Status') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                        <td class="wf-100"><?= $this->getHtml('Name') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                        <td><?= $this->getHtml('Members') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                <tbody>
                    <?php $c = 0; foreach ($this->getData('list:elements') as $key => $value) : ++$c;
                        $url = \phpOMS\Uri\UriFactory::build('{/prefix}admin/group/settings?{?}&id=' . $value->getId());
                        $color = 'darkred';
                            if ($value->getStatus() === \phpOMS\Account\GroupStatus::ACTIVE) { $color = 'green'; }
                            elseif ($value->getStatus() === \phpOMS\Account\GroupStatus::INACTIVE) { $color = 'darkblue'; }
                            elseif ($value->getStatus() === \phpOMS\Account\GroupStatus::HIDDEN) { $color = 'purple'; } ?>
                    <tr data-href="<?= $url; ?>">
                        <td data-label="<?= $this->getHtml('ID', '0', '0') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
                        <td data-label="<?= $this->getHtml('Status') ?>"><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->getHtml('Status'. $value->getStatus()); ?></span></a>
                        <td data-label="<?= $this->getHtml('Name') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
                        <td data-label="<?= $this->getHtml('Members') ?>">
                    <?php endforeach; ?>
                    <?php if ($c === 0) : ?>
                    <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                    <?php endif; ?>
            </table>
            <div class="portlet-foot"></div>
        </div>
    </div>
</div>