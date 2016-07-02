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
                <td><?= $this->l11n->lang['Admin']['Name'] ?>
                <td><?= $modules[$id]['name']['external']; ?>
            <tr>
                <td><?= $this->l11n->lang['Admin']['Version'] ?>
                <td><?= $modules[$id]['version'] ?>
            <tr>
                <td><?= $this->l11n->lang['Admin']['CreatedBy'] ?>
                <td><?= $modules[$id]['creator']['name'] ?>
            <tr>
                <td><?= $this->l11n->lang['Admin']['Website'] ?>
                <td><?= $modules[$id]['creator']['website'] ?>
            <tr>
                <td><?= $this->l11n->lang['Admin']['Description'] ?>
                <td><?= $modules[$id]['description'] ?>
            <tr>
                <td colspan="2">
                    <?php if (in_array($id, $active)) : ?>
                        <button
                            data-reload="<?= \phpOMS\Uri\UriFactory::build('POST:/{/lang}/backend/admin/module/status?status=deactivate&module=' . $id); ?>"><?= $this->l11n->lang['Admin']['Deactivate'] ?></button>
                    <?php elseif (in_array($id, $installed)) : ?>
                        <button data-reload="<?= \phpOMS\Uri\UriFactory::build('POST:/{/lang}/backend/admin/module/deactivate?id=' . $id); ?>"><?= $this->l11n->lang['Admin']['Uninstall'] ?></button>
                        <button data-reload="<?= \phpOMS\Uri\UriFactory::build('POST:/{/lang}/backend/admin/module/deactivate?id=' . $id); ?>"><?= $this->l11n->lang['Admin']['Activate'] ?></button>
                    <?php elseif (isset($modules[$id])) : ?>
                        <button data-reload="<?= \phpOMS\Uri\UriFactory::build('PUT:/{/lang}/backend/admin/module/install?id=' . $id); ?>"><?= $this->l11n->lang['Admin']['Install'] ?></button>
                        <button data-reload="<?= \phpOMS\Uri\UriFactory::build('DELETE:/{/lang}/backend/admin/module/delete?id=' . $id); ?>"><?= $this->l11n->lang['Admin']['Delete'] ?></button>
                    <?php endif; ?>
        </table>
    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->lang['Admin']['Settings'] ?></h1></header>

    <div class="inner">

    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->lang['Admin']['Groups'] ?></h1></header>

    <div class="inner">

    </div>
</section>

<section class="box w-33 floatLeft">
    <header><h1><?= $this->l11n->lang['Admin']['Permissions'] ?></h1></header>

    <div class="inner">

    </div>
</section>
