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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render(); ?>

<div class="tabular-2">
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getText('Master') ?></label></li>
            <li><label for="c-tab-2"><?= $this->getText('Contact') ?></label></li>
            <li><label for="c-tab-3"><?= $this->getText('Addresses') ?></label></li>
            <li><label for="c-tab-4"><?= $this->getText('PaymentTerm') ?></label></li>
            <li><label for="c-tab-5"><?= $this->getText('Payment') ?></label></li>
            <li><label for="c-tab-6"><?= $this->getText('Files') ?></label></li>
            <li><label for="c-tab-7"><?= $this->getText('Logs') ?></label>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Supplier') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iId"><?= $this->getText('ID', 0, 0); ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="number" id="iId" min="1" name="id" required></span>
                            <tr><td><label for="iName1"><?= $this->getText('Name1'); ?></label>
                            <tr><td><input type="text" id="iName1" name="name1" placeholder="&#xf040;" required>
                            <tr><td><label for="iName2"><?= $this->getText('Name2'); ?></label>
                            <tr><td><input type="text" id="iName2" name="name2" placeholder="&#xf040;">
                            <tr><td><label for="iName3"><?= $this->getText('Name3'); ?></label>
                            <tr><td><input type="text" id="iName3" name="name3" placeholder="&#xf040;">
                            <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Contact') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iCType"><?= $this->getText('Type'); ?></label>
                            <tr><td><select id="iCType" name="actype">
                                        <option><?= $this->getText('Email'); ?>
                                        <option><?= $this->getText('Fax'); ?>
                                        <option><?= $this->getText('Phone'); ?>
                                    </select>
                            <tr><td><label for="iCStype"><?= $this->getText('Subtype'); ?></label>
                            <tr><td><select id="iCStype" name="acstype">
                                        <option><?= $this->getText('Office'); ?>
                                        <option><?= $this->getText('Sales'); ?>
                                        <option><?= $this->getText('Purchase'); ?>
                                        <option><?= $this->getText('Accounting'); ?>
                                        <option><?= $this->getText('Support'); ?>
                                    </select>
                            <tr><td><label for="iCInfo"><?= $this->getText('Info'); ?></label>
                            <tr><td><input type="text" id="iCInfo" name="cinfo">
                            <tr><td><label for="iCData"><?= $this->getText('Contact'); ?></label>
                            <tr><td><input type="text" id="iCData" name="cdata">
                            <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-3" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Address') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iAType"><?= $this->getText('Type'); ?></label>
                            <tr><td><select id="iAType" name="atype">
                                        <option><?= $this->getText('Default'); ?>
                                        <option><?= $this->getText('Delivery'); ?>
                                        <option><?= $this->getText('Invoice'); ?>
                                    </select>
                            <tr><td><label for="iAddress"><?= $this->getText('Address'); ?></label>
                            <tr><td><input type="text" id="iAddress" name="address">
                            <tr><td><label for="iZip"><?= $this->getText('Zip'); ?></label>
                            <tr><td><input type="text" id="iZip" name="zip">
                            <tr><td><label for="iCountry"><?= $this->getText('Country'); ?></label>
                            <tr><td><input type="text" id="iCountry" name="country">
                            <tr><td><label for="iAInfo"><?= $this->getText('Info'); ?></label>
                            <tr><td><input type="text" id="iAInfo" name="ainfo">
                            <tr><td><span class="check"><input type="checkbox" id="iDefault" name="default" checked><label for="iDefault"><?= $this->getText('IsDefault'); ?></label></span>
                            <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-4" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('PaymentTerm') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iSource"><?= $this->getText('ID') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iSource" name="source" type="text" placeholder=""></span>
                            <tr><td><label for="iSegment"><?= $this->getText('Segment') ?></label>
                            <tr><td><input id="iSegment" name="segment" type="text" placeholder="">
                            <tr><td><label for="iProductgroup"><?= $this->getText('Productgroup') ?></label>
                            <tr><td><input id="iProductgroup" name="productgroup" type="text" placeholder="">
                            <tr><td><label for="iGroup"><?= $this->getText('Group') ?></label>
                            <tr><td><input id="iGroup" name="group" type="text" placeholder="">
                            <tr><td><label for="iArticlegroup"><?= $this->getText('Articlegroup') ?></label>
                            <tr><td><input id="iArticlegroup" name="articlegroup" type="text" placeholder="">
                            <tr><td><label for="iTerm"><?= $this->getText('Type') ?></label>
                            <tr><td><select id="iTerm" name="term" required>
                                        <option>
                                    </select>
                            <tr><td><span class="check"><input type="checkbox" id="iFreightage" name="freightage"><label for="iFreightage"><?= $this->getText('Freightage') ?></label></span>
                            <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-5" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Payment') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iACType"><?= $this->getText('Type'); ?></label>
                            <tr><td><select id="iACType" name="actype">
                                        <option><?= $this->getText('Wire'); ?>
                                        <option><?= $this->getText('Creditcard'); ?>
                                    </select>
                            <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-6" name="tabular-2">
        <div class="tab">
        </div>
        <input type="radio" id="c-tab-7" name="tabular-2">
        <div class="tab">
            <?php
            $footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
            $footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
            $footerView->setPages(20);
            $footerView->setPage(1);
            ?>
            <div class="box w-100">
                <table class="table red">
                    <caption><?= $this->getText('Logs') ?></caption>
                    <thead>
                    <tr>
                        <td>IP
                        <td><?= $this->getText('ID', 0, 0); ?>
                        <td><?= $this->getText('Name'); ?>
                        <td class="wf-100"><?= $this->getText('Log'); ?>
                        <td><?= $this->getText('Date'); ?>
                    <tfoot>
                    <tr>
                        <td colspan="6"><?= $footerView->render(); ?>
                    <tbody>
                    <tr>
                        <td><?= $this->request->getOrigin(); ?>
                        <td><?= $this->request->getAccount(); ?>
                        <td><?= $this->request->getAccount(); ?>
                        <td>Creating suppier
                        <td><?= (new \DateTime('now'))->format('Y-m-d H:i:s') ?>
                </table>
            </div>
        </div>
    </div>
</div>
