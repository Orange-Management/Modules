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

$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$modules   = $this->app->moduleManager->getAllModules();
$active    = $this->app->moduleManager->getActiveModules();
$installed = $this->app->moduleManager->getInstalledModules();

$footerView->setPages(count($modules) / 25);
$footerView->setPage(1);
$footerView->setResults(count($modules));
?>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->getText('Admin', 'Backend', 'Modules'); ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->getText(0, 'Backend', 'ID'); ?>
            <td class="wf-100"><?= $this->l11n->getText('Admin', 'Backend', 'Name'); ?>
            <td><?= $this->l11n->getText('Admin', 'Backend', 'Version'); ?>
            <td><?= $this->l11n->getText('Admin', 'Backend', 'Status'); ?>
                <tfoot>
        <tr>
            <td colspan="4"><?= $footerView->render(); ?>
                <tbody>
                <?php $count = 0; foreach ($modules as $key => $module) : $count++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/admin/module/settings?id=' . $module['name']['internal']); ?>
        <tr>
            <td><a href="<?= $url; ?>"><?= $module['name']['internal']; ?></a>
            <td><a href="<?= $url; ?>"><?= $module['name']['external']; ?></a>
            <td><a href="<?= $url; ?>"><?= $module['version']; ?></a>
            <td><a href="<?= $url; ?>"><?php if (in_array($module['name']['internal'], $active))
                    echo strtolower($this->l11n->getText('Admin', 'Backend', 'Active'));
                elseif (in_array($module['name']['internal'], $installed))
                    echo strtolower($this->l11n->getText('Admin', 'Backend', 'Inactive'));
                else
                    echo strtolower($this->l11n->getText('Admin', 'Backend', 'Available')); ?></a>
                <?php endforeach; ?>
        <?php if($count === 0) : ?>
            <tr><td colspan="4" class="empty"><?= $this->l11n->getText(0, 'Backend', 'Empty'); ?>
        <?php endif; ?>
    </table>
</div>
