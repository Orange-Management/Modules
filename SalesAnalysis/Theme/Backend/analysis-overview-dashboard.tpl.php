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
            <li><label for="c-tab2-1"><?= $this->l11n->getText('SalesAnalysis', 'Overview'); ?></label>
            <li><label for="c-tab2-2"><?= $this->l11n->getText('SalesAnalysis', 'Month'); ?></label>
            <li><label for="c-tab2-3"><?= $this->l11n->getText('SalesAnalysis', 'Year'); ?></label>
            <li><label for="c-tab2-4"><?= $this->l11n->getText('SalesAnalysis', 'Top10'); ?></label>
            <li><label for="c-tab2-5"><?= $this->l11n->getText('SalesAnalysis', 'Charts'); ?></label>
        </ul>
        <div class="tab-content">
            <input type="radio" id="c-tab2-1" name="tabular-2" checked>
            <div class="tab">
                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->l11n->getText('SalesAnalysis', 'Overview') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Type'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'LastMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'CurrentMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Change'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'LastYear'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'CurrentYear'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Change'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'LastYearAcc'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'CurrentYearAcc'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Change'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'LastYear'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Forecast'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Change'); ?>
                        <tbody>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Domestic'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Export'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Developed'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Undeveloped'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Europe'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'America'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Asia'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Africa'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Total'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                    </table>
                </section>

                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->l11n->getText('SalesAnalysis', 'Misc') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Type'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'LastYear'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'CurrentYear'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'LastMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'CurrentMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Yesterday'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Today'); ?>
                        <tbody>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Customers'); ?><td><td><td><td><td><td>
                            <tr><th><?= $this->l11n->getText('SalesAnalysis', 'Invoices'); ?><td><td><td><td><td><td>
                    </table>
                </section>
            </div>
            <input type="radio" id="c-tab2-2" name="tabular-2">
            <div class="tab tab-2">
                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->l11n->getText('SalesAnalysis', 'Month') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Day'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Day'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'LastMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'CurrentMonth'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Change'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'ChangeAcc'); ?>
                        <tbody>
                        <tr><td><td><td><td><td><td>
                    </table>
                </section>
            </div>
            <input type="radio" id="c-tab2-3" name="tabular-2">
            <div class="tab tab-3">
                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->l11n->getText('SalesAnalysis', 'Year') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'Year'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'January'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'February'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'March'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'April'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'May'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'June'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'July'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'August'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'September'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'October'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'November'); ?>
                            <td><?= $this->l11n->getText('SalesAnalysis', 'December'); ?>
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
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Customers'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Products'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Employees'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
            </div>
            <input type="radio" id="c-tab2-5" name="tabular-2">
            <div class="tab tab-5">
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Domestic/Export'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Developed/Undeveloped'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Continents'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-100 floatLeft">
                    <header>
                        <h1><?= $this->l11n->getText('SalesAnalysis', 'Development'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>