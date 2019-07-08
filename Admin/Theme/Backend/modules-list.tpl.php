<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Admin\Template\Backend
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
use phpOMS\Module\ModuleStatus;

/**
 * @var \phpOMS\Views\View $this
 */

$modules   = $this->app->moduleManager->getAllModules();
$active    = $this->app->moduleManager->getActiveModules();
$installed = $this->app->moduleManager->getInstalledModules();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table id="moduleList" class="default">
                <caption><?= $this->getHtml('Modules') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td class="wf-100"><?= $this->getHtml('Name') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td><?= $this->getHtml('Version') ?>
                    <td><?= $this->getHtml('Status') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                        <tfoot>
                <tr>
                    <td colspan="4">
                        <tbody>
                        <?php $count = 0; foreach ($modules as $key => $module) : ++$count;
                        $url = \phpOMS\Uri\UriFactory::build('{/prefix}admin/module/settings?{?}&id=' . $module['name']['internal']);
                            if (isset($active[$module['name']['internal']])) { $status = ModuleStatus::ACTIVE; }
                            elseif (isset($installed[$module['name']['internal']])) { $status = ModuleStatus::INACTIVE; }
                            else { $status = ModuleStatus::AVAILABLE; }
                        ?>
                <tr data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('ID', '0', '0') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($module['name']['id']); ?></a>
                    <td data-label="<?= $this->getHtml('Name') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($module['name']['external']); ?></a>
                    <td data-label="<?= $this->getHtml('Version') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($module['version']); ?></a>
                    <td data-label="<?= $this->getHtml('Status') ?>">
                        <span class="tag <?php
                            if ($status === ModuleStatus::ACTIVE)
                                echo 'green';
                            elseif ($status === ModuleStatus::INACTIVE)
                                echo 'red';
                            else
                                echo 'blue';
                        ?>">
                            <a href="<?= $url; ?>">
                                <?php if ($status === ModuleStatus::ACTIVE)
                                    echo \mb_strtolower($this->getHtml('Active'));
                                elseif ($status === ModuleStatus::INACTIVE)
                                    echo \mb_strtolower($this->getHtml('Inactive'));
                                else
                                    echo \mb_strtolower($this->getHtml('Available')); ?>
                            </a>
                            <?php endforeach; ?>
                        </span>
                <?php if ($count === 0) : ?>
                    <tr><td colspan="4" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
