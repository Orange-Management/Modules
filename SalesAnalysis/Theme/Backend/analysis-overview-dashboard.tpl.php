<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
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
            <li><label for="c-tab2-1"><?= $this->getText('Overview'); ?></label>
            <li><label for="c-tab2-2"><?= $this->getText('Month'); ?></label>
            <li><label for="c-tab2-3"><?= $this->getText('Year'); ?></label>
            <li><label for="c-tab2-4"><?= $this->getText('Top10'); ?></label>
            <li><label for="c-tab2-5"><?= $this->getText('Charts'); ?></label>
        </ul>
        <div class="tab-content">
            <input type="radio" id="c-tab2-1" name="tabular-2" checked>
            <div class="tab">
                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->getText('Overview') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->getText('Type'); ?>
                            <td><?= $this->getText('LastMonth'); ?>
                            <td><?= $this->getText('CurrentMonth'); ?>
                            <td><?= $this->getText('Change'); ?>
                            <td><?= $this->getText('LastYear'); ?>
                            <td><?= $this->getText('CurrentYear'); ?>
                            <td><?= $this->getText('Change'); ?>
                            <td><?= $this->getText('LastYearAcc'); ?>
                            <td><?= $this->getText('CurrentYearAcc'); ?>
                            <td><?= $this->getText('Change'); ?>
                            <td><?= $this->getText('LastYear'); ?>
                            <td><?= $this->getText('Forecast'); ?>
                            <td><?= $this->getText('Change'); ?>
                        <tbody>
                            <tr><th><?= $this->getText('Domestic'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->getText('Export'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->getText('Developed'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->getText('Undeveloped'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->getText('Europe'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->getText('America'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->getText('Asia'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->getText('Africa'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                            <tr><th><?= $this->getText('Total'); ?><td><td><td><td><td><td><td><td><td><td><td><td>
                    </table>
                </section>

                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->getText('Misc') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->getText('Type'); ?>
                            <td><?= $this->getText('LastYear'); ?>
                            <td><?= $this->getText('CurrentYear'); ?>
                            <td><?= $this->getText('LastMonth'); ?>
                            <td><?= $this->getText('CurrentMonth'); ?>
                            <td><?= $this->getText('Yesterday'); ?>
                            <td><?= $this->getText('Today'); ?>
                        <tbody>
                            <tr><th><?= $this->getText('Customers'); ?><td><td><td><td><td><td>
                            <tr><th><?= $this->getText('Invoices'); ?><td><td><td><td><td><td>
                    </table>
                </section>
            </div>
            <input type="radio" id="c-tab2-2" name="tabular-2">
            <div class="tab tab-2">
                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->getText('Month') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->getText('Day'); ?>
                            <td><?= $this->getText('Day'); ?>
                            <td><?= $this->getText('LastMonth'); ?>
                            <td><?= $this->getText('CurrentMonth'); ?>
                            <td><?= $this->getText('Change'); ?>
                            <td><?= $this->getText('ChangeAcc'); ?>
                        <tbody>
                        <tr><td><td><td><td><td><td>
                    </table>
                </section>
            </div>
            <input type="radio" id="c-tab2-3" name="tabular-2">
            <div class="tab tab-3">
                <section class="box wf-100 floatLeft">
                    <table class="table">
                        <caption><?= $this->getText('Year') ?></caption>
                        <thead>
                        <tr>
                            <td><?= $this->getText('Year'); ?>
                            <td><?= $this->getText('January'); ?>
                            <td><?= $this->getText('February'); ?>
                            <td><?= $this->getText('March'); ?>
                            <td><?= $this->getText('April'); ?>
                            <td><?= $this->getText('May'); ?>
                            <td><?= $this->getText('June'); ?>
                            <td><?= $this->getText('July'); ?>
                            <td><?= $this->getText('August'); ?>
                            <td><?= $this->getText('September'); ?>
                            <td><?= $this->getText('October'); ?>
                            <td><?= $this->getText('November'); ?>
                            <td><?= $this->getText('December'); ?>
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
                        <h1><?= $this->getText('Customers'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->getText('Products'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->getText('Employees'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
            </div>
            <input type="radio" id="c-tab2-5" name="tabular-2">
            <div class="tab tab-5">
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->getText('Domestic/Export'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->getText('Developed/Undeveloped'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-33 floatLeft">
                    <header>
                        <h1><?= $this->getText('Continents'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
                <section class="box w-100 floatLeft">
                    <header>
                        <h1><?= $this->getText('Development'); ?></h1>
                    </header>
                    <div class="inner">
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>