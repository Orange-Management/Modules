<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */

$modules   = $this->app->moduleManager->getAllModules();
$active    = $this->app->moduleManager->getActiveModules();
$installed = $this->app->moduleManager->getInstalledModules();

$id = $this->request->getData('id') ?? 1;
?>

<section class="box w-33 floatLeft">
    <header><h1><?= $modules[$id]['name']['external'] ?></h1></header>

    <div class="inner">
        <table class="list wf-100">
            <tbody>
            <tr>
                <td><?= $this->getText('Name') ?>
                <td><?= $modules[$id]['name']['external']; ?>
            <tr>
                <td><?= $this->getText('Version') ?>
                <td><?= $modules[$id]['version'] ?>
            <tr>
                <td><?= $this->getText('CreatedBy') ?>
                <td><?= $modules[$id]['creator']['name'] ?>
            <tr>
                <td><?= $this->getText('Website') ?>
                <td><?= $modules[$id]['creator']['website'] ?>
            <tr>
                <td><?= $this->getText('Description') ?>
                <td><?= $modules[$id]['description'] ?>
            <tr>
                <td colspan="2">
                    <?php if (in_array($id, $active)) : ?>
                        <button
                            data-reload="<?= \phpOMS\Uri\UriFactory::build('POST:/{/lang}/backend/admin/module/status?status=deactivate&module=' . $id); ?>"><?= $this->getText('Deactivate') ?></button>
                    <?php elseif (in_array($id, $installed)) : ?>
                        <button data-reload="<?= \phpOMS\Uri\UriFactory::build('POST:/{/lang}/backend/admin/module/deactivate?id=' . $id); ?>"><?= $this->getText('Uninstall') ?></button>
                        <button data-reload="<?= \phpOMS\Uri\UriFactory::build('POST:/{/lang}/backend/admin/module/deactivate?id=' . $id); ?>"><?= $this->getText('Activate') ?></button>
                    <?php elseif (isset($modules[$id])) : ?>
                        <button data-reload="<?= \phpOMS\Uri\UriFactory::build('PUT:/{/lang}/backend/admin/module/install?id=' . $id); ?>"><?= $this->getText('Install') ?></button>
                        <button data-reload="<?= \phpOMS\Uri\UriFactory::build('DELETE:/{/lang}/backend/admin/module/delete?id=' . $id); ?>"><?= $this->getText('Delete') ?></button>
                    <?php endif; ?>
        </table>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Settings') ?></h1></header>

    <div class="inner">

    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Groups') ?></h1></header>

    <div class="inner">

    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->getText('Permissions') ?></h1></header>

    <div class="inner">

    </div>
</section>
