<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Admin\Template\Backend
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

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
        <section class="box wf-100">
            <header><h1><?= $this->printHtml($modules[$id]['name']['external'] ); ?></h1></header>

            <div class="inner">
                <table class="list wf-100">
                    <tbody>
                    <tr>
                        <td><?= $this->getHtml('Name'); ?>
                        <td><?= $this->printHtml($modules[$id]['name']['external']); ?>
                    <tr>
                        <td><?= $this->getHtml('Version'); ?>
                        <td><?= $this->printHtml($modules[$id]['version'] ); ?>
                    <tr>
                        <td><?= $this->getHtml('CreatedBy'); ?>
                        <td><?= $this->printHtml($modules[$id]['creator']['name'] ); ?>
                    <tr>
                        <td><?= $this->getHtml('Website'); ?>
                        <td><?= $this->printHtml($modules[$id]['creator']['website'] ); ?>
                    <tr>
                        <td><?= $this->getHtml('Description'); ?>
                        <td><?= $this->printHtml($modules[$id]['description'] ); ?>
                    <tr>
                        <td colspan="2">
                            <?php if (isset($active[$id])) : ?>
                                <form id="fModuleDeactivate" action="<?= \phpOMS\Uri\UriFactory::build('{/lang}/api/admin/module/status?module=' . $id); ?>" method="POST">
                                    <button id="fModuleDeactivateButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::DEACTIVATE ?>"><?= $this->getHtml('Deactivate'); ?></button>
                                </form>
                            <?php elseif (isset($installed[$id])) : ?>
                                <div class="ipt-wrap">
                                    <div class="ipt-first">
                                        <form id="fModuleUninstall" action="<?= \phpOMS\Uri\UriFactory::build('{/lang}/api/admin/module/status?module=' . $id); ?>" method="POST">
                                            <button id="fModuleUninstallButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::UNINSTALL ?>"><?= $this->getHtml('Uninstall'); ?></button>
                                        </form>
                                    </div>
                                    <div class="ipt-second">
                                        <form id="fModuleActivate" action="<?= \phpOMS\Uri\UriFactory::build('{/lang}/api/admin/module/status?module=' . $id); ?>" method="POST">
                                            <button id="fModuleActivateButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::ACTIVATE ?>"><?= $this->getHtml('Activate'); ?></button>
                                        </form>
                                    </div>
                                </div>
                            <?php elseif (isset($modules[$id])) : ?>
                                <div class="ipt-wrap">
                                    <div class="ipt-first">
                                        <form id="fModuleInstall" action="<?= \phpOMS\Uri\UriFactory::build('{/lang}/api/admin/module/status?module=' . $id); ?>" method="POST">
                                            <button id="fModuleInstallButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::INSTALL ?>"><?= $this->getHtml('Install'); ?></button>
                                        </form>
                                    </div>
                                    <div class="ipt-second">
                                        <form id="fModuleDelete" action="<?= \phpOMS\Uri\UriFactory::build('{/lang}/api/admin/module/status?module=' . $id); ?>" method="POST">
                                            <button id="fModuleDeleteButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::DELETE ?>"><?= $this->getHtml('Delete'); ?></button>
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>
                </table>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Settings'); ?></h1></header>

            <div class="inner">

            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Groups'); ?></h1></header>

            <div class="inner">

            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Permissions'); ?></h1></header>

            <div class="inner">

            </div>
        </section>
    </div>
</div>
