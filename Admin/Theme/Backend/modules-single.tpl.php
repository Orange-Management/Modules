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
                                <form id="fModuleDeactivate" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/module/status?module=' . $id); ?>" method="POST">
                                    <button id="fModuleDeactivateButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::DEACTIVATE ?>"><?= $this->getHtml('Deactivate'); ?></button>
                                </form>
                            <?php elseif (isset($installed[$id])) : ?>
                                <form id="fModuleUninstall" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/module/status?module=' . $id); ?>" method="POST">
                                    <button id="fModuleUninstallButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::UNINSTALL ?>"><?= $this->getHtml('Uninstall'); ?></button>
                                </form>
                                <form id="fModuleActivate" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/module/status?module=' . $id); ?>" method="POST">
                                    <button id="fModuleActivateButton" name="status" type="submit" value="<?= ModuleStatusUpdateType::ACTIVATE ?>"><?= $this->getHtml('Activate'); ?></button>
                                </form>
                            <?php elseif (isset($modules[$id])) : ?>
                                <button id="iModuleInstallButton" name="status" value="<?= ModuleStatusUpdateType::INSTALL ?>" data-action='[
                                    {
                                        "key": 1, "listener": "click", "action": [
                                            {"key": 1, "type": "dom.getvalue", "base": "self", "selector": ""},
                                            {"key": 2, "type": "message.request", "uri": "<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/module/status?module=' . $id); ?>", "method": "POST", "request_type": "json"},
                                            {"key": 3, "type": "message.log"},
                                            {"key": 4, "type": "utils.timer", "id": "iModuleInstallButton", "delay": 1500, "resets": true},
                                            {"key": 5, "type": "redirect", "uri": "{%}", "target": "self"}
                                        ]
                                    }
                                ]'><?= $this->getHtml('Install'); ?></button>
                                <button id="iModuleDeleteButton" name="status" value="<?= ModuleStatusUpdateType::DELETE ?>" data-action='[
                                    {
                                        "key": 1, "listener": "click", "action": [
                                            {"key": 1, "type": "message.request", "uri": "<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/module/status?module=' . $id); ?>", "method": "POST", "request_type": "json"},
                                            {"key": 2, "type": "message.log"}
                                        ]
                                    }
                                ]'><?= $this->getHtml('Delete', 0); ?></button>
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
