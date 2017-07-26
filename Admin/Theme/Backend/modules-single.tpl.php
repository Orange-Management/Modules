<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
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

<div class="row">
    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= htmlspecialchars($modules[$id]['name']['external'] , ENT_COMPAT, 'utf-8'); ?></h1></header>

            <div class="inner">
                <table class="list wf-100">
                    <tbody>
                    <tr>
                        <td><?= $this->getHtml('Name'); ?>
                        <td><?= htmlspecialchars($modules[$id]['name']['external'], ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Version'); ?>
                        <td><?= htmlspecialchars($modules[$id]['version'] , ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('CreatedBy'); ?>
                        <td><?= htmlspecialchars($modules[$id]['creator']['name'] , ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Website'); ?>
                        <td><?= htmlspecialchars($modules[$id]['creator']['website'] , ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td><?= $this->getHtml('Description'); ?>
                        <td><?= htmlspecialchars($modules[$id]['description'] , ENT_COMPAT, 'utf-8'); ?>
                    <tr>
                        <td colspan="2">
                            <?php if (in_array($id, $active)) : ?>
                                <button
                                    data-reload="<?= \phpOMS\Uri\UriFactory::build('POST:/{/lang}/backend/admin/module/status?{?}&status=deactivate&module=' . $id); ?>"><?= $this->getHtml('Deactivate'); ?></button>
                            <?php elseif (in_array($id, $installed)) : ?>
                                <button data-reload="<?= \phpOMS\Uri\UriFactory::build('POST:/{/lang}/backend/admin/module/deactivate?{?}&id=' . $id); ?>"><?= $this->getHtml('Uninstall'); ?></button>
                                <button data-reload="<?= \phpOMS\Uri\UriFactory::build('POST:/{/lang}/backend/admin/module/deactivate?{?}&id=' . $id); ?>"><?= $this->getHtml('Activate'); ?></button>
                            <?php elseif (isset($modules[$id])) : ?>
                                <button data-reload="<?= \phpOMS\Uri\UriFactory::build('PUT:/{/lang}/backend/admin/module/install?{?}&id=' . $id); ?>"><?= $this->getHtml('Install'); ?></button>
                                <button data-reload="<?= \phpOMS\Uri\UriFactory::build('DELETE:/{/lang}/backend/admin/module/delete?{?}&id=' . $id); ?>"><?= $this->getHtml('Delete', 0); ?></button>
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
