<?php declare(strict_types=1);
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

/**
 * @var \phpOMS\Views\View $this
 */

$modules = $this->app->moduleManager->getInstalledModules();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table id="moduleList" class="default">
                <caption><?= $this->getHtml('Modules') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td class="wf-100"><?= $this->getHtml('Name') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                <tfoot>
                <tr>
                    <td>
                <tbody>
                <?php
                $count = 0;
                foreach ($modules as $key => $module) :
                    if ((\realpath(__DIR__ . '/../../../' . $module['directory'] . '/Docs/Help/en/SUMMARY.md')) === false) {
                        continue;
                    }

                    ++$count;
                    $url = \phpOMS\Uri\UriFactory::build(
                        '{/lang}/backend/help/module/single?id={$module}',
                        ['$module' => $module['name']['internal']]
                    );
                ?>
                    <tr data-href="<?= $url; ?>">
                        <td data-label="<?= $this->getHtml('Name') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($module['name']['external']); ?></a>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                    <tr><td class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>