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

$footerView->setPages(1 / 25);
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
                    <td><input type="submit" value="<?= $this->l11n->getText(0, 'Search') ?>">
                    <td class="rightText"><button type="button"><i class="fa fa-print"></i></button>
            </table>
        </form>
    </div>
</section>

<section class="box w-100">
    <div class="inner">
        <table class="list wf-100">
            <tr><th><?= $this->l11n->getText('AccountsReceivable']['DSO'] ?>:<td class="wf-33">0<th><?= $this->l11n->lang['AccountsReceivable']['Paid'] ?>:<td class="wf-33">0<th><?= $this->l11n->lang['AccountsReceivable', 'Balance') ?>:<td class="wf-33">0
            <tr><th><?= $this->l11n->getText('AccountsReceivable']['CreditLimit'] ?>:<td class="wf-33">0<th><?= $this->l11n->lang['AccountsReceivable']['Due'] ?>:<td class="wf-33">0<th><?= $this->l11n->lang['AccountsReceivable', 'Selected') ?>:<td class="wf-33">0
        </table>
    </div>
</section>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->getText('Accounting', 'Entries') ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->getText('Accounting', 'EntryDate'); ?>
            <td><?= $this->l11n->getText('Accounting', 'Receipt'); ?>
            <td><?= $this->l11n->getText('Accounting', 'Debit'); ?>
            <td><?= $this->l11n->getText('Accounting', 'Credit'); ?>
            <td class="wf-100"><?= $this->l11n->getText('Accounting', 'Text'); ?>
            <td><?= $this->l11n->getText('AccountsReceivable', 'Due'); ?>
            <td><?= $this->l11n->getText('AccountsReceivable', 'Paid'); ?>
            <td><?= $this->l11n->getText('Accounting', 'ReceiptDate'); ?>
            <td><?= $this->l11n->getText('Accounting', 'ExternalVoucher'); ?>
            <td><?= $this->l11n->getText('Accounting', 'Creator'); ?>
            <td><?= $this->l11n->getText('Accounting', 'Created'); ?>
        <tbody>
        <?php $count = 0;
        foreach ([] as $key => $value) : $count++; ?>
        <?php endforeach; ?>
        <?php if ($count === 0) : ?>
        <tr>
            <td colspan="13" class="empty"><?= $this->l11n->getText(0, 'Empty'); ?>
                <?php endif; ?>
    </table>
</div>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->getText('Accounting', 'Entries') ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->getText('Accounting', 'EntryDate'); ?>
            <td><?= $this->l11n->getText('Accounting', 'Receipt'); ?>
            <td><?= $this->l11n->getText('Accounting', 'Debit'); ?>
            <td><?= $this->l11n->getText('Accounting', 'Credit'); ?>
            <td class="wf-100"><?= $this->l11n->getText('Accounting', 'Text'); ?>
            <td><?= $this->l11n->getText('AccountsReceivable', 'Due'); ?>
            <td><?= $this->l11n->getText('AccountsReceivable', 'Paid'); ?>
            <td><?= $this->l11n->getText('Accounting', 'ReceiptDate'); ?>
            <td><?= $this->l11n->getText('Accounting', 'ExternalVoucher'); ?>
            <td><?= $this->l11n->getText('Accounting', 'Creator'); ?>
            <td><?= $this->l11n->getText('Accounting', 'Created'); ?>
        <tbody>
        <?php $count = 0;
        foreach ([] as $key => $value) : $count++; ?>
        <?php endforeach; ?>
        <?php if ($count === 0) : ?>
        <tr>
            <td colspan="13" class="empty"><?= $this->l11n->getText(0, 'Empty'); ?>
                <?php endif; ?>
    </table>
</div>
