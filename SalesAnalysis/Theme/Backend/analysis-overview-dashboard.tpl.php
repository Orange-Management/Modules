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

echo $this->getData('nav')->render(); ?>

<div class="box w-100">
    <div class="tabular-2">
        <ul class="tab-links">
            <li><label for="c-tab2-1"><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Overview'); ?></label>
            <li><label for="c-tab2-2"><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Month'); ?></label>
            <li><label for="c-tab2-3"><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Year'); ?></label>
            <li><label for="c-tab2-4"><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Top10'); ?></label>
            <li><label for="c-tab2-5"><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Charts'); ?></label>
        </ul>
        <div class="tab-content">
            <input type="radio" id="c-tab2-1" name="tabular-2" checked>
            <div class="tab">
                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Overview') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Type'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'LastMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'CurrentMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Change'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'LastYear'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'CurrentYear'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Change'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'LastYearAcc'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'CurrentYearAcc'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Change'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'LastYear'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Forecast'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Change'); ?>
                        <tbody>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Domestic'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Export'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Developed'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Undeveloped'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Europe'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'America'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Asia'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Africa'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Total'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                    </table>
                </section>

                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Misc') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Type'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'LastYear'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'CurrentYear'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'LastMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'CurrentMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Yesterday'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Today'); ?>
                        <tbody>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Customers'); ?><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Invoices'); ?><td><td><td><td><td><td>
                    </table>
                </section>
            </div>
            <input type="radio" id="c-tab2-2" name="tabular-2">
            <div class="tab tab-2">
                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Month') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Day'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Day'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'LastMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'CurrentMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Change'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'ChangeAcc'); ?>
                        <tbody>
                        <tr><td><td><td><td><td><td>
                    </table>
                </section>
            </div>
            <input type="radio" id="c-tab2-3" name="tabular-2">
            <div class="tab tab-3">
                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Year') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Year'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'January'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'February'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'March'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'April'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'May'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'June'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'July'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'August'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'September'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'October'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'November'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'December'); ?>
                        <tbody>
                        <tr><th>2013<td><td><td><td><td><td><td><td><td><td><td><td>
                        <tr><th>2014<td><td><td><td><td><td><td><td><td><td><td><td>
                        <tr><th>2015<td><td><td><td><td><td><td><td><td><td><td><td>
                        <tr><th>CY 2016<td><td><td><td><td><td><td><td><td><td><td><td>
                        <tr><th>2017<td><td><td><td><td><td><td><td><td><td><td><td>
                        <tr><th>2018<td><td><td><td><td><td><td><td><td><td><td><td>
                        <tr><th>2019<td><td><td><td><td><td><td><td><td><td><td><td>
                        <tr><th>2020<td><td><td><td><td><td><td><td><td><td><td><td>
                        <tr><th>2021<td><td><td><td><td><td><td><td><td><td><td><td>
                    </table>
                </section>
            </div>
            <input type="radio" id="c-tab2-4" name="tabular-2">
            <div class="tab tab-4">
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Customers'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Products'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Employees'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
            </div>
            <input type="radio" id="c-tab2-5" name="tabular-2">
            <div class="tab tab-5">
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Domestic/Export'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Developed/Undeveloped'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Continents'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-100 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Backend', 'Development'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>