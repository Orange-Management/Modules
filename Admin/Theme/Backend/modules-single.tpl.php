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


use Modules\Admin\Models\ModuleStatusUpdateType;

/**
 * @var \phpOMS\Views\View $this
 */
$modules   = $this->getData('modules');
$active    = $this->getData('active');
$installed = $this->getData('installed');
$id        = $this->getData('id');

$nav = $this->getData('nav');

if ($nav !== null) {
    echo $this->getData('nav')->render();
}
?>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="portlet">
            <div class="portlet-head"><?= $this->printHtml($modules[$id]['name']['external']); ?></div>

            <div class="portlet-body">
                <table class="list wf-100">
                    <tbody>
                    <tr>
                        <td><?= $this->getHtml('Name'); ?>
                        <td><?= $this->printHtml($modules[$id]['name']['external']); ?>
                    <tr>
                        <td><?= $this->getHtml('Version'); ?>
                        <td><?= $this->printHtml($modules[$id]['version']); ?>
                    <tr>
                        <td><?= $this->getHtml('CreatedBy'); ?>
                        <td><?= $this->printHtml($modules[$id]['creator']['name']); ?>
                    <tr>
                        <td><?= $this->getHtml('Website'); ?>
                        <td><?= $this->printHtml($modules[$id]['creator']['website']); ?>
                    <tr>
                        <td><?= $this->getHtml('Description'); ?>
                        <td><?= $this->printHtml($modules[$id]['description']); ?>
                </table>
            </div>
            <div class="portlet-foot">
                <?php if (isset($active[$id])) : ?>
                    <form id="fModuleDeactivate" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/module/status?module=' . $id); ?>" method="POST">
                        <button id="fModuleDeactivateButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::DEACTIVATE ?>"><?= $this->getHtml('Deactivate'); ?></button>
                    </form>
                <?php elseif (isset($installed[$id])) : ?>
                    <div class="ipt-wrap">
                        <div class="ipt-first">
                            <form id="fModuleUninstall" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/module/status?module=' . $id); ?>" method="POST">
                                <button id="fModuleUninstallButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::UNINSTALL ?>"><?= $this->getHtml('Uninstall'); ?></button>
                            </form>
                        </div>
                        <div class="ipt-second">
                            <form id="fModuleActivate" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/module/status?module=' . $id); ?>" method="POST">
                                <button id="fModuleActivateButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::ACTIVATE ?>"><?= $this->getHtml('Activate'); ?></button>
                            </form>
                        </div>
                    </div>
                <?php elseif (isset($modules[$id])) : ?>
                    <div class="ipt-wrap">
                        <div class="ipt-first">
                            <form id="fModuleInstall" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/module/status?module=' . $id); ?>" method="POST">
                                <button id="fModuleInstallButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::INSTALL ?>"><?= $this->getHtml('Install'); ?></button>
                            </form>
                        </div>
                        <div class="ipt-second">
                            <form id="fModuleDelete" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/module/status?module=' . $id); ?>" method="POST">
                                <button id="fModuleDeleteButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::DELETE ?>"><?= $this->getHtml('Delete'); ?></button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-4">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Settings'); ?></div>

            <div class="portlet-body">

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-4">
        <div class="portlet">
            <table id="iModuleGroupList" class="default">
                <caption><?= $this->getHtml('Permissions') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                    <tr>
                        <td><?= $this->getHtml('ID', '0', '0'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                        <td>Type<i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                        <td class="wf-100"><?= $this->getHtml('Name'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                <tbody>
                    <?php $c = 0; $groupPermissions = $this->getData('groupPermissions');
                    foreach ($groupPermissions as $key => $value) : ++$c;
                    $url = \phpOMS\Uri\UriFactory::build('{/prefix}admin/group/settings?{?}&id=' . $value->getId()); ?>
                    <tr data-href="<?= $url; ?>">
                        <td><a href="<?= $url; ?>"><i class="fa fa-times"></i></a>
                        <td><a href="<?= $url; ?>">Group</a>
                        <td><a href="<?= $url; ?>"><?= $value->getName(); ?></a>
                    <?php endforeach; ?>
                    <?php if ($c === 0) : ?>
                    <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                    <?php endif; ?>
            </table>
        </div>
    </div>
</div>
