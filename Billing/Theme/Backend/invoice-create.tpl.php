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
            <li><label for="c-tab-1"><?= $this->getText('Invoice') ?></label></li>
            <li><label for="c-tab-2"><?= $this->getText('Items') ?></label></li>
            <li><label for="c-tab-3">Preview</label></li>
            <li><label for="c-tab-4"><?= $this->getText('Payment') ?></label></li>
            <li><label for="c-tab-5"><?= $this->getText('Media') ?></label></li>
            <li><label for="c-tab-6"><?= $this->getText('Logs') ?></label></li>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getText('Invoice') ?></h1></header>
                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tr><td><label for="iSource"><?= $this->getText('Source') ?></label>
                                    <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iSource" name="source"></span>
                                    <tr><td><label for="iType"><?= $this->getText('Type') ?></label>
                                    <tr><td><select id="iType" name="type">
                                                <option><?= $this->getText('Invoice') ?>
                                                <option><?= $this->getText('Offer') ?>
                                                <option><?= $this->getText('Confirmation') ?>
                                                <option><?= $this->getText('DeliveryNote') ?>
                                                <option><?= $this->getText('CreditNote') ?>
                                            </select>
                                    <tr><td><label for="iClient"><?= $this->getText('Client') ?></label>
                                    <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iClient" name="client"></span>
                                    <tr><td><label for="iDelivery"><?= $this->getText('Delivery') ?></label>
                                    <tr><td><input type="datetime-local" id="iDelivery" name="delivery">
                                    <tr><td><label for="iDue"><?= $this->getText('Due') ?></label>
                                    <tr><td><input type="datetime-local" id="iDue" name="due">
                                    <tr><td><label for="iFreightage"><?= $this->getText('Freightage') ?></label>
                                    <tr><td><input type="number" id="iFreightage" name="freightage">
                                    <tr><td><label for="iShipment"><?= $this->getText('Shipment') ?></label>
                                    <tr><td><select id="iShipment" name="shipment">
                                                <option>
                                            </select>
                                    <tr><td><label for="iTermsOfDelivery"><?= $this->getText('TermsOfDelivery') ?></label>
                                    <tr><td><select id="iTermsOfDelivery" name="termsofdelivery">
                                                <option>
                                            </select>
                                    <tr><td colspan="3"><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getText('Invoice') ?></h1></header>
                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tr><td><label for="iAddressS"><?= $this->getText('Addresses') ?></label>
                                    <tr><td><select id="iAddressS" name="addressS">
                                                <option>
                                            </select>
                                    <tr><td><label for="iIRecipient"><?= $this->getText('Recipient') ?></label>
                                    <tr><td><input type="text" id="iIRecipient" name="irecipient">
                                    <tr><td><label for="iAddress"><?= $this->getText('Address') ?></label>
                                    <tr><td><input type="text" id="iAddress" name="address">
                                    <tr><td><label for="iZip"><?= $this->getText('Zip') ?></label>
                                    <tr><td><input type="text" id="iZip" name="zip">
                                    <tr><td><label for="iCity"><?= $this->getText('City') ?></label>
                                    <tr><td><input type="text" id="iCity" name="city">
                                    <tr><td><label for="iCountry"><?= $this->getText('Country') ?></label>
                                    <tr><td><input type="text" id="iCountry" name="country">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getText('Delivery') ?></h1></header>
                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tr><td><label for="iAddressS"><?= $this->getText('Addresses') ?></label>
                                    <tr><td><select id="iAddressS" name="addressS">
                                                <option>
                                            </select>
                                    <tr><td><label for="iDRecipient"><?= $this->getText('Recipient') ?></label>
                                    <tr><td><input type="text" id="iDRecipient" name="drecipient">
                                    <tr><td><label for="iAddress"><?= $this->getText('Address') ?></label>
                                    <tr><td><input type="text" id="iAddress" name="address">
                                    <tr><td><label for="iZip"><?= $this->getText('Zip') ?></label>
                                    <tr><td><input type="text" id="iZip" name="zip">
                                    <tr><td><label for="iCity"><?= $this->getText('City') ?></label>
                                    <tr><td><input type="text" id="iCity" name="city">
                                    <tr><td><label for="iCountry"><?= $this->getText('Country') ?></label>
                                    <tr><td><input type="text" id="iCountry" name="country">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box wf-100">
                        <table class="table red">
                            <caption><?= $this->getText('Invoice') ?></caption>
                            <thead>
                            <tr>
                                <td>
                                <td><?= $this->getText('Item'); ?>
                                <td><?= $this->getText('Variation'); ?>
                                <td class="wf-100"><?= $this->getText('Name'); ?>
                                <td><?= $this->getText('Quantity'); ?>
                                <td><?= $this->getText('Discount'); ?>
                                <td><?= $this->getText('DiscountP'); ?>
                                <td><?= $this->getText('Bonus'); ?>
                                <td><?= $this->getText('Tax'); ?>
                                <td><?= $this->getText('Net'); ?>
                            <tfoot>
                            <tr>
                                <td colspan="8"><!-- todo: make this look nicer. even as alpha release this looks bad. -->
                                    <?= $this->getText('Freightage'); ?>: 0.00 -
                                    <?= $this->getText('Net'); ?>: 0.00 -
                                    <?= $this->getText('Tax'); ?>: 0.00 -
                                    <?= $this->getText('Total'); ?>: 0.00
                            <tbody>
                            <tr>
                                <td><i class="fa fa-plus"></i> <i class="fa fa-chevron-up"></i> <i class="fa fa-chevron-down"></i>
                                <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" required></span>
                                <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" required></span>
                                <td><input type="text" required><!-- todo: make this textarea -->
                                <td><input type="number" min="0" value="0" required>
                                <td><input type="number" min="0">
                                <td><input type="number" min="0" max="100" step="any">
                                <td><input type="number" min="0" step="any">
                                <td><input type="number" min="0" step="any">
                                <td>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-3" name="tabular-2">
        <div class="tab">
        </div>
        <input type="radio" id="c-tab-4" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getText('Payment') ?></h1></header>
                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tr><td><label for="iType"><?= $this->getText('Type') ?></label>
                                    <tr><td><select id="iType" name="type">
                                                <option>
                                            </select>
                                    <tr><td><label for="iType"><?= $this->getText('Type') ?></label>
                                    <tr><td><select id="iType" name="type">
                                                <option><?= $this->getText('MoneyTransfer') ?>
                                                <option><?= $this->getText('Prepaid') ?>
                                                <option><?= $this->getText('AlreadyPaid') ?>
                                                <option><?= $this->getText('CreditCard') ?>
                                                <option><?= $this->getText('DirectDebit') ?>
                                            </select>
                                    <tr><td><label for="iDue"><?= $this->getText('Due') ?></label>
                                    <tr><td><input type="datetime-local" id="iDue" name="due">
                                    <tr><td><label for="iDue"><?= $this->getText('Due') ?> - <?= $this->getText('Cashback') ?></label>
                                    <tr><td><input type="datetime-local" id="iDue" name="due">
                                    <tr><td><label for="iCashBack"><?= $this->getText('Cashback') ?></label>
                                    <tr><td><input type="number" id="iCashBack" name="cashback">
                                    <tr><td><label for="iDue"><?= $this->getText('Due') ?> - <?= $this->getText('Cashback') ?> 2</label>
                                    <tr><td><input type="datetime-local" id="iDue" name="due">
                                    <tr><td><label for="iCashBack2"><?= $this->getText('Cashback') ?> 2</label>
                                    <tr><td><input type="number" id="iCashBack2" name="cashback2">
                                    <tr><td colspan="3"><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-5" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getText('Media'); ?></h1></header>

                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td colspan="2"><label for="iMedia"><?= $this->getText('Media'); ?></label>
                                    <tr><td><input type="text" id="iMedia" placeholder="&#xf15b; File"><td><button><?= $this->getText('Select'); ?></button>
                                    <tr><td colspan="2"><label for="iUpload"><?= $this->getText('Upload'); ?></label>
                                    <tr><td><input type="file" id="iUpload" form="fTask"><input form="fTask" type="hidden" name="type"><td>
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-6" name="tabular-2">
        <div class="tab">
            <?php
            $footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
            $footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
            $footerView->setPages(20);
            $footerView->setPage(1);
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box wf-100">
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
                                <td>Create Invoice
                                <td><?= (new \DateTime('now'))->format('Y-m-d H:i:s') ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

