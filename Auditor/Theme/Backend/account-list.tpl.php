<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Auditor
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View $this
 */
$accounts = $this->getData('accounts');

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
                    <td class="wf-100"><?= $this->getHtml('Email') ?>
                <tfoot>
                <tr>
                    <td colspan="2">
                <tbody>
                <?php $count = 0; foreach ($accounts as $key => $account) : ++$count;
                $url = \phpOMS\Uri\UriFactory::build('{/prefix}admin/audit/single?{?}&id=' . $account->getId()); ?>
                    <tr data-href="<?= $url; ?>">
                        <td><?= $this->printHtml($account->getId()); ?>
                        <td><?= $this->printHtml(
                            \sprintf('%3$s %2$s %1$s', $account->getName1(), $account->getName2(), $account->getName3())
                        ); ?>
                        <td><?= $this->printHtml($account->getEmail()); ?>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                <tr><td colspan="2" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>