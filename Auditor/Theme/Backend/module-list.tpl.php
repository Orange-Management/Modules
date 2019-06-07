<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
/**
 * @var \phpOMS\Views\View $this
 */

$modules = $this->getData('modules');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="default">
                <caption><?= $this->getHtml('Audits') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
                <tfoot>
                <tr>
                    <td colspan="2">
                <tbody>
                <?php $count = 0; foreach ($modules as $key => $module) : ++$count;
                $url = \phpOMS\Uri\UriFactory::build('{/prefix}admin/audit/single?{?}&id=' . $module['name']['id']); ?>
                    <tr data-href="<?= $url; ?>">
                        <td><?= $this->printHtml($module['name']['id']); ?>
                        <td><?= $this->printHtml($module['name']['external']); ?>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                <tr><td colspan="2" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>