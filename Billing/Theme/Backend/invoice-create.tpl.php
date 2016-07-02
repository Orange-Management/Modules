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

<div class="tabular-2">
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->l11n->getText('Billing', 'Invoice') ?></label></li>
            <li><label for="c-tab-2"><?= $this->l11n->getText('Billing', 'Items') ?></label></li>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <section class="box w-50 floatLeft">
                <header><h1><?= $this->l11n->getText('Billing', 'Invoice') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout wf-100">
                            <tr><td><label for="iSource"><?= $this->l11n->getText('Billing', 'Source') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iSource" name="source"></span>
                            <tr><td><label for="iType"><?= $this->l11n->getText('Billing', 'Type') ?></label>
                            <tr><td><select id="iType" name="type">
                                        <option><?= $this->l11n->getText('Billing', 'Invoice') ?>
                                        <option><?= $this->l11n->getText('Billing', 'Offer') ?>
                                        <option><?= $this->l11n->getText('Billing', 'Confirmation') ?>
                                        <option><?= $this->l11n->getText('Billing', 'DeliveryNote') ?>
                                        <option><?= $this->l11n->getText('Billing', 'CreditNote') ?>
                                    </select>
                            <tr><td><label for="iClient"><?= $this->l11n->getText('Billing', 'Client') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iClient" name="client"></span>
                            <tr><td><label for="iDelivery"><?= $this->l11n->getText('Billing', 'Delivery') ?></label>
                            <tr><td><input type="datetime-local" id="iDelivery" name="delivery">
                            <tr><td><label for="iDue"><?= $this->l11n->getText('Billing', 'Due') ?></label>
                            <tr><td><input type="datetime-local" id="iDue" name="due">
                            <tr><td><label for="iFreightage"><?= $this->l11n->getText('Billing', 'Freightage') ?></label>
                            <tr><td><input type="number" id="iFreightage" name="freightage">
                            <tr><td><label for="iShipment"><?= $this->l11n->getText('Billing', 'Shipment') ?></label>
                            <tr><td><select id="iShipment" name="shipment">
                                        <option>
                                    </select>
                            <tr><td colspan="3"><input type="submit" value="<?= $this->l11n->getText(0, 'Create') ?>">
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <header><h1><?= $this->l11n->getText('Billing', 'Invoice') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout wf-100">
                            <tr><td><label for="iAddressS"><?= $this->l11n->getText('Billing', 'Addresses') ?></label>
                            <tr><td><select id="iAddressS" name="addressS">
                                        <option>
                                    </select>
                            <tr><td><label for="iIRecipient"><?= $this->l11n->getText('Billing', 'Recipient') ?></label>
                            <tr><td><input type="text" id="iIRecipient" name="irecipient">
                            <tr><td><label for="iAddress"><?= $this->l11n->getText('Billing', 'Address') ?></label>
                            <tr><td><input type="text" id="iAddress" name="address">
                            <tr><td><label for="iZip"><?= $this->l11n->getText('Billing', 'Zip') ?></label>
                            <tr><td><input type="text" id="iZip" name="zip">
                            <tr><td><label for="iCity"><?= $this->l11n->getText('Billing', 'City') ?></label>
                            <tr><td><input type="text" id="iCity" name="city">
                            <tr><td><label for="iCountry"><?= $this->l11n->getText('Billing', 'Country') ?></label>
                            <tr><td><input type="text" id="iCountry" name="country">
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <header><h1><?= $this->l11n->getText('Billing', 'Delivery') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout wf-100">
                            <tr><td><label for="iAddressS"><?= $this->l11n->getText('Billing', 'Addresses') ?></label>
                            <tr><td><select id="iAddressS" name="addressS">
                                        <option>
                                    </select>
                            <tr><td><label for="iDRecipient"><?= $this->l11n->getText('Billing', 'Recipient') ?></label>
                            <tr><td><input type="text" id="iDRecipient" name="drecipient">
                            <tr><td><label for="iAddress"><?= $this->l11n->getText('Billing', 'Address') ?></label>
                            <tr><td><input type="text" id="iAddress" name="address">
                            <tr><td><label for="iZip"><?= $this->l11n->getText('Billing', 'Zip') ?></label>
                            <tr><td><input type="text" id="iZip" name="zip">
                            <tr><td><label for="iCity"><?= $this->l11n->getText('Billing', 'City') ?></label>
                            <tr><td><input type="text" id="iCity" name="city">
                            <tr><td><label for="iCountry"><?= $this->l11n->getText('Billing', 'Country') ?></label>
                            <tr><td><input type="text" id="iCountry" name="country">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
            <div class="box w-100">
                <table class="table">
                    <caption><?= $this->l11n->getText('Billing', 'Invoice') ?></caption>
                    <thead>
                    <tr>
                        <td>
                        <td><?= $this->l11n->getText('Billing', 'Item'); ?>
                        <td><?= $this->l11n->getText('Billing', 'Variation'); ?>
                        <td class="wf-100"><?= $this->l11n->getText('Billing', 'Name'); ?>
                        <td><?= $this->l11n->getText('Billing', 'Quantity'); ?>
                        <td><?= $this->l11n->getText('Billing', 'Discount'); ?>
                        <td><?= $this->l11n->getText('Billing', 'DiscountP'); ?>
                        <td><?= $this->l11n->getText('Billing', 'Bonus'); ?>
                        <td><?= $this->l11n->getText('Billing', 'Tax'); ?>
                        <td><?= $this->l11n->getText('Billing', 'Net'); ?>
                    <tfoot>
                    <tr>
                        <td colspan="8"><!-- todo: make this look nicer. even as alpha release this looks bad. -->
                            <?= $this->l11n->getText('Billing', 'Freightage'); ?>: 0.00 -
                            <?= $this->l11n->getText('Billing', 'Net'); ?>: 0.00 -
                            <?= $this->l11n->getText('Billing', 'Tax'); ?>: 0.00 -
                            <?= $this->l11n->getText('Billing', 'Total'); ?>: 0.00
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
                        <td>
                        <td>
                </table>
            </div>
        </div>
    </div>
</div>
