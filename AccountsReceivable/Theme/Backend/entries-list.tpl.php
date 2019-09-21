<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\AccountsReceivable
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
/**
 * @var \phpOMS\Views\View $this
 */

$footerView = new \phpOMS\Views\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(25);
$footerView->setPage(1);
$footerView->setResults(1);

echo $this->getData('nav')->render(); ?>

<section class="box w-100">
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr>
                    <td style="width: 200px"><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i>
                            </button><input type="number" id="iId" min="1" name="id" required></span>
                    <td><input type="submit" value="<?= $this->getHtml('Search'); ?>">
                    <td class="rightText"><button type="button"><i class="fa fa-print"></i></button>
            </table>
        </form>
    </div>
</section>

<section class="box w-100">
    <div class="inner">
        <table class="list wf-100">
            <tr><th><?= $this->getHtml('AccountsReceivable', 'DSO'); ?>:<td class="wf-33">0<th><?= $this->getHtml('AccountsReceivable', 'Paid'); ?>:<td class="wf-33">0<th><?= $this->getHtml('Balance'); ?>:<td class="wf-33">0
            <tr><th><?= $this->getHtml('AccountsReceivable', 'CreditLimit'); ?>:<td class="wf-33">0<th><?= $this->getHtml('AccountsReceivable', 'Due'); ?>:<td class="wf-33">0<th><?= $this->getHtml('Selected'); ?>:<td class="wf-33">0
        </table>
    </div>
</section>

<div class="box w-100">
    <table class="default">
        <caption><?= $this->getHtml('Entries'); ?><i class="fa fa-download floatRight download btn"></i></caption>
        <thead>
        <tr>
            <td><?= $this->getHtml('EntryDate') ?>
            <td><?= $this->getHtml('Receipt') ?>
            <td><?= $this->getHtml('Debit') ?>
            <td><?= $this->getHtml('Credit') ?>
            <td class="wf-100"><?= $this->getHtml('Text') ?>
            <td><?= $this->getHtml('Due') ?>
            <td><?= $this->getHtml('Paid') ?>
            <td><?= $this->getHtml('ReceiptDate') ?>
            <td><?= $this->getHtml('ExternalVoucher') ?>
            <td><?= $this->getHtml('Creator') ?>
            <td><?= $this->getHtml('Created') ?>
        <tbody>
        <?php $count = 0;
        foreach ([] as $key => $value) : ++$count; ?>
        <?php endforeach; ?>
        <?php if ($count === 0) : ?>
        <tr>
            <td colspan="13" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
    </table>
</div>

<div class="box w-100">
    <table class="default">
        <caption><?= $this->getHtml('Entries'); ?><i class="fa fa-download floatRight download btn"></i></caption>
        <thead>
        <tr>
            <td><?= $this->getHtml('EntryDate') ?>
            <td><?= $this->getHtml('Receipt') ?>
            <td><?= $this->getHtml('Debit') ?>
            <td><?= $this->getHtml('Credit') ?>
            <td class="wf-100"><?= $this->getHtml('Text') ?>
            <td><?= $this->getHtml('Due') ?>
            <td><?= $this->getHtml('Paid') ?>
            <td><?= $this->getHtml('ReceiptDate') ?>
            <td><?= $this->getHtml('ExternalVoucher') ?>
            <td><?= $this->getHtml('Creator') ?>
            <td><?= $this->getHtml('Created') ?>
        <tbody>
        <?php $count = 0;
        foreach ([] as $key => $value) : ++$count; ?>
        <?php endforeach; ?>
        <?php if ($count === 0) : ?>
        <tr>
            <td colspan="13" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
    </table>
</div>
