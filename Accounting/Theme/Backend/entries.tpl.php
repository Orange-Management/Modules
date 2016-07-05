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
//echo $this->getData('nav')->render();

$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(1 / 25);
$footerView->setPage(1);
$footerView->setResults(1);
?>

<section class="box w-100">
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr>
                    <td><label for="iAccountStart"><?= $this->l11n->getText('Accounting', 'Backend', 'Account'); ?></label>
                    <td><label for="iAccountStart"><?= $this->l11n->getText('Accounting', 'Backend', 'CostCenter'); ?>
                    <td><label for="iAccountStart"><?= $this->l11n->getText('Accounting', 'Backend', 'CostObject'); ?>
                    <td><label for="iAccountStart"><?= $this->l11n->getText('Accounting', 'Backend', 'EntryDate'); ?>
                <tr>
                    <td><span class="input"><button type="button" id="account-start" formaction="" data-action='[{"type": "popup", "tpl": "entry-list-tpl", "aniIn": "fadeIn", "aniOut": "fadeOut", "stay": 1000}]'><i class="fa fa-book"></i>
                            </button><input type="number" id="iId" min="1" name="id" required></span>
                    <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i>
                            </button><input type="number" id="iId" min="1" name="id" required></span>
                    <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i>
                            </button><input type="number" id="iId" min="1" name="id" required></span>
                    <td><input type="datetime-local" id="iId" min="1" name="id" required>
                <tr>
                    <td><label for="iAccountStart"><?= $this->l11n->getText('Accounting', 'Backend', 'To'); ?></label>
                    <td><label for="iAccountStart"><?= $this->l11n->getText('Accounting', 'Backend', 'To'); ?>
                    <td><label for="iAccountStart"><?= $this->l11n->getText('Accounting', 'Backend', 'To'); ?>
                    <td><label for="iAccountStart"><?= $this->l11n->getText('Accounting', 'Backend', 'To'); ?>
                <tr>
                    <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i>
                            </button><input type="number" id="iId" min="1" name="id" required></span>
                    <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i>
                            </button><input type="number" id="iId" min="1" name="id" required></span>
                    <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i>
                            </button><input type="number" id="iId" min="1" name="id" required></span>
                    <td><input type="datetime-local" id="iId" min="1" name="id" required>
                <tr>
                    <td colspan="4"><input type="submit" value="<?= $this->l11n->getText(0, 'Backend', 'Search') ?>">
            </table>
        </form>
    </div>
</section>

<div class="box w-100">
    <div class="tabular-2">
        <ul class="tab-links">
            <li><label for="c-tab2-1"><?= $this->l11n->getText('Accounting', 'Backend', 'List'); ?></label></li>
            <li><label for="c-tab2-2"><?= $this->l11n->getText('Accounting', 'Backend', 'Evaluation'); ?></label></li>
            <li><label for="c-tab2-3"><?= $this->l11n->getText('Accounting', 'Backend', 'Charts'); ?></label></li>
        </ul>
        <div class="tab-content">
            <input type="radio" id="c-tab2-1" name="tabular-2" checked>
            <div class="tab">
                <section class="wf-100">
                    <table class="table">
                        <caption><?= $this->l11n->getText('Accounting', 'Backend', 'Entries') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'EntryDate'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Receipt'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Debit'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Credit'); ?>
                            <td class="wf-100"><?= $this->l11n->getText('Accounting', 'Backend', 'Text'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Account'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'ContraAccount'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'CostCenter'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'CostObject'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'ReceiptDate'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'ExternalVoucher'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Creator'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Created'); ?>
                        <tfoot>
                        <tr>
                            <td colspan="13"><?= $footerView->render(); ?>
                        <tbody>
                        <?php $count = 0;
                        foreach ([] as $key => $value) : $count++; ?>
                        <?php endforeach; ?>
                        <?php if ($count === 0) : ?>
                        <tr>
                            <td colspan="13" class="empty"><?= $this->l11n->getText(0, 'Backend', 'Empty'); ?>
                                <?php endif; ?>
                    </table>
                </section>
            </div>
            <input type="radio" id="c-tab2-2" name="tabular-2">
            <div class="tab tab-2">
                <section class="box w-33 floatLeft">
                    <table class="table">
                        <caption><?= $this->l11n->getText('Accounting', 'Backend', 'Accounts') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Account'); ?>
                            <td class="wf-100"><?= $this->l11n->getText('Accounting', 'Backend', 'Name'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Total'); ?>
                        <tbody>
                        <?php $count = 0;
                        foreach ([] as $key => $value) : $count++; ?>
                        <?php endforeach; ?>
                        <?php if ($count === 0) : ?>
                        <tr>
                            <td colspan="13" class="empty"><?= $this->l11n->getText(0, 'Backend', 'Empty'); ?>
                                <?php endif; ?>
                    </table>
                </section>
                <section class="box w-33 floatLeft">
                    <table class="table floatLeft">
                        <caption><?= $this->l11n->getText('Accounting', 'Backend', 'CostCenter') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'CostCenter'); ?>
                            <td class="wf-100"><?= $this->l11n->getText('Accounting', 'Backend', 'Name'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Total'); ?>
                        <tbody>
                        <?php $count = 0;
                        foreach ([] as $key => $value) : $count++; ?>
                        <?php endforeach; ?>
                        <?php if ($count === 0) : ?>
                        <tr>
                            <td colspan="13" class="empty"><?= $this->l11n->getText(0, 'Backend', 'Empty'); ?>
                                <?php endif; ?>
                    </table>
                </section>
                <section class="box w-33 floatLeft">
                    <table class="table">
                        <caption><?= $this->l11n->getText('Accounting', 'Backend', 'CostObject') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Account'); ?>
                            <td class="wf-100"><?= $this->l11n->getText('Accounting', 'Backend', 'Name'); ?>
                            <td><?= $this->l11n->getText('Accounting', 'Backend', 'Total'); ?>
                        <tbody>
                        <?php $count = 0;
                        foreach ([] as $key => $value) : $count++; ?>
                        <?php endforeach; ?>
                        <?php if ($count === 0) : ?>
                        <tr>
                            <td colspan="13" class="empty"><?= $this->l11n->getText(0, 'Backend', 'Empty'); ?>
                                <?php endif; ?>
                    </table>
                </section>
            </div>
            <input type="radio" id="c-tab2-3" name="tabular-2">
            <div class="tab tab-3">
                <section class="box w-50 floatLeft">
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-50 floatLeft">
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-50 floatLeft">
                    <div class="inner">
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<?php include 'account-list.tpl.php'; ?>