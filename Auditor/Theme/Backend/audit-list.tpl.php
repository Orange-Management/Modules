<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
/**
 * @var \phpOMS\Views\View $this
 */
$audits = $this->getData('audits') ?? [];
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="default fixed">
                <caption><?= $this->getHtml('Audits') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <colgroup>
                    <col style="width: 100px">
                    <col style="width: 150px">
                    <col style="width: 75px">
                    <col style="width: 75px">
                    <col>
                    <col>
                    <col>
                    <col style="width: 125px">
                    <col style="width: 150px">
                </colgroup>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td ><?= $this->getHtml('Module') ?>
                    <td ><?= $this->getHtml('Type') ?>
                    <td ><?= $this->getHtml('Subtype') ?>
                    <td ><?= $this->getHtml('Old') ?>
                    <td ><?= $this->getHtml('New') ?>
                    <td ><?= $this->getHtml('Content') ?>
                    <td ><?= $this->getHtml('By') ?>
                    <td ><?= $this->getHtml('Date') ?>
                <tfoot>
                <tr>
                    <td colspan="9">
                <tbody>
                <?php $count = 0; foreach ($audits as $key => $audit) : ++$count;
                $url = \phpOMS\Uri\UriFactory::build('{/prefix}admin/audit/single?{?}&id=' . $audit->getId()); ?>
                    <tr data-href="<?= $url; ?>">
                        <td><?= $audit->getId(); ?>
                        <td><?= $this->printHtml($audit->getModule()); ?>
                        <td><?= $audit->getType(); ?>
                        <td><?= $audit->getSubtype(); ?>
                        <td><?= $this->printHtml($audit->getOld()); ?>
                        <td><?= $this->printHtml($audit->getNew()); ?>
                        <td><?= $this->printHtml($audit->getContent()); ?>
                        <td><?= $this->printHtml($audit->getCreatedBy()->getName()); ?>
                        <td><?= $audit->getCreatedAt()->format('Y-m-d H:i'); ?>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                    <tr><td colspan="9" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
