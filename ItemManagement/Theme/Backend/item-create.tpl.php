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
            <li><label for="c-tab-1"><?= $this->getText('Master') ?></label>
            <li><label for="c-tab-2"><?= $this->getText('Properties') ?></label>
            <li><label for="c-tab-4"><?= $this->getText('Sales') ?></label>
            <li><label for="c-tab-5"><?= $this->getText('Purchase') ?></label>
            <li><label for="c-tab-6"><?= $this->getText('Accounting') ?></label>
            <li><label for="c-tab-7"><?= $this->getText('Production') ?></label>
            <li><label for="c-tab-8"><?= $this->getText('StockList') ?></label>
            <li><label for="c-tab-9"><?= $this->getText('QM') ?></label>
            <li><label for="c-tab-10"><?= $this->getText('Packaging') ?></label>
            <li><label for="c-tab-11"><?= $this->getText('Media') ?></label>
            <li><label for="c-tab-12"><?= $this->getText('Stock') ?></label>
            <li><label for="c-tab-13"><?= $this->getText('Disposal') ?></label>
            <li><label for="c-tab-14"><?= $this->getText('Files') ?></label>
            <li><label for="c-tab-15"><?= $this->getText('Logs') ?></label>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getText('Item') ?></h1></header>
                        <div class="inner">
                            <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iSource"><?= $this->getText('ID') ?></label>
                                    <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iSource" name="source" type="text" placeholder="" required></span>
                                    <tr><td><label for="iSegment"><?= $this->getText('Segment') ?></label>
                                    <tr><td><input id="iSegment" name="segment" type="text" placeholder="" required>
                                    <tr><td><label for="iProductgroup"><?= $this->getText('Productgroup') ?></label>
                                    <tr><td><input id="iProductgroup" name="productgroup" type="text" placeholder="" required>
                                    <tr><td><label for="iGroup"><?= $this->getText('Group') ?></label>
                                    <tr><td><input id="iGroup" name="group" type="text" placeholder="" required>
                                    <tr><td><label for="iArticlegroup"><?= $this->getText('Articlegroup') ?></label>
                                    <tr><td><input id="iArticlegroup" name="articlegroup" type="text" placeholder="" required>
                                    <tr><td><label for="iSSuccessor"><?= $this->getText('Successor') ?></label>
                                    <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iSource" name="source" type="text" placeholder=""></span>
                                    <tr><td><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getText('Language') ?></h1></header>
                        <div class="inner">
                            <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iLanguage"><?= $this->getText('Language') ?></label>
                                    <tr><td><select id="iLanguage" name="language">
                                                <option>
                                            </select>
                                    <tr><td><label for="iName"><?= $this->getText('Name1') ?></label>
                                    <tr><td><input id="iName" name="name" type="text" placeholder="">
                                    <tr><td><label for="iName"><?= $this->getText('Name2') ?></label>
                                    <tr><td><input id="iName" name="name" type="text" placeholder="">
                                    <tr><td><label for="iName"><?= $this->getText('Name3') ?></label>
                                    <tr><td><input id="iName" name="name" type="text" placeholder="">
                                    <tr><td><label for="iDescription"><?= $this->getText('Description') ?></label>
                                    <tr><td><textarea id="iDescription" name="description"></textarea>
                                    <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Property') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Name') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iPCustomsId" name="customsid" type="text" placeholder=""></span>
                            <tr><td><label for="iPTradingUnit"><?= $this->getText('Unit') ?></label>
                            <tr><td><select id="iPTracking" name="tracking">
                                        <option>
                                    </select>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Value') ?></label>
                            <tr><td><input id="iPCustomsId" name="customsid" type="text" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Language') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPTradingUnit"><?= $this->getText('Language') ?></label>
                            <tr><td><select id="iPTracking" name="tracking">
                                        <option>
                                    </select>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Property') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iPCustomsId" name="customsid" type="text" placeholder=""></span>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Translation') ?></label>
                            <tr><td><input id="iPCustomsId" name="customsid" type="text" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Language') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPTradingUnit"><?= $this->getText('Language') ?></label>
                            <tr><td><select id="iPTracking" name="tracking">
                                        <option>
                                    </select>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Value') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iPCustomsId" name="customsid" type="text" placeholder=""></span>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Translation') ?></label>
                            <tr><td><input id="iPCustomsId" name="customsid" type="text" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Attribute') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Name') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iPCustomsId" name="customsid" type="text" placeholder=""></span>
                            <tr><td><label for="iPTradingUnit"><?= $this->getText('Unit') ?></label>
                            <tr><td><select id="iPTracking" name="tracking">
                                        <option>
                                    </select>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Value') ?></label>
                            <tr><td><input id="iPCustomsId" name="customsid" type="text" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Language') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPTradingUnit"><?= $this->getText('Language') ?></label>
                            <tr><td><select id="iPTracking" name="tracking">
                                        <option>
                                    </select>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Attribute') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iPCustomsId" name="customsid" type="text" placeholder=""></span>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Translation') ?></label>
                            <tr><td><input id="iPCustomsId" name="customsid" type="text" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Language') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPTradingUnit"><?= $this->getText('Language') ?></label>
                            <tr><td><select id="iPTracking" name="tracking">
                                        <option>
                                    </select>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Value') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iPCustomsId" name="customsid" type="text" placeholder=""></span>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('Translation') ?></label>
                            <tr><td><input id="iPCustomsId" name="customsid" type="text" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-4" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Sales') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPType"><?= $this->getText('Status') ?></label>
                            <tr><td><select id="iPType" name="ptye">
                                        <option>
                                    </select>
                            <tr><td><label for="iPrice">GTIN</label>
                            <tr><td><input id="iPrice" name="price" type="text" placeholder="">
                            <tr><td colspan="2"><label for="iPPriceUnit"><?= $this->getText('PriceUnit') ?></label>
                            <tr><td><select id="iPPriceUnit" name="ppriceunit">
                                        <option value="0">
                                    </select><td>
                            <tr><td colspan="2"><label for="iPQuantityUnit"><?= $this->getText('QuantityUnit') ?></label>
                            <tr><td><select id="iPQuantityUnit" name="pquantityunit">
                                        <option value="0">
                                    </select><td>
                            <tr><td><label for="iPTradingUnit"><?= $this->getText('TradingUnit') ?></label>
                            <tr><td><input id="iPTradingUnit" name="tradingunit" type="number" min="0" step="any" placeholder="">
                            <tr><td><label for="iPTracking"><?= $this->getText('Tracking') ?></label>
                            <tr><td><select id="iPTracking" name="tracking">
                                        <option><?= $this->getText('None') ?>
                                        <option><?= $this->getText('Lot') ?>
                                        <option><?= $this->getText('SN') ?>
                                        <option><?= $this->getText('Purchase') ?>
                                    </select>
                            <tr><td><label for="iPVariation"><?= $this->getText('Commission') ?></label>
                            <tr><td><select id="iPVariation" name="pvariation">
                                        <option value="0">
                                    </select>
                            <tr><td><label for="iPCustomsId"><?= $this->getText('CustomsID') ?></label>
                            <tr><td><input id="iPCustomsId" name="customsid" type="text" placeholder="">
                            <tr><td><label for="iSInfo"><?= $this->getText('Info') ?></label>
                            <tr><td><textarea id="iSInfo" name="sinfo"></textarea>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Price') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td colspan="2"><label for="iPName"><?= $this->getText('Name') ?></label>
                            <tr><td><input id="iPName" name="pname" type="text" placeholder=""><td>
                            <tr><td colspan="2"><label for="iPrice"><?= $this->getText('Start') ?></label>
                            <tr><td><input id="iPrice" name="price" type="datetime-local"><td>
                            <tr><td colspan="2"><label for="iPrice"><?= $this->getText('End') ?></label>
                            <tr><td><input id="iPrice" name="price" type="datetime-local"><td>
                            <tr><td colspan="2"><label for="iPType"><?= $this->getText('Country') ?></label>
                            <tr><td><select id="iPType" name="ptye">
                                        <option>
                                    </select><td>
                            <tr><td colspan="2"><label for="iPQuantity"><?= $this->getText('Quantity') ?></label>
                            <tr><td><input id="iPQuantity" name="quantity" type="text" placeholder=""><td>
                            <tr><td colspan="2"><label for="iPrice"><?= $this->getText('Price') ?></label>
                            <tr><td><input id="iPrice" name="price" type="number" step="any" min="0" placeholder=""><td>
                            <tr><td colspan="2"><label for="iDiscount"><?= $this->getText('Discount') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder=""><td>
                            <tr><td colspan="2"><label for="iDiscount"><?= $this->getText('DiscountP') ?></label>
                            <tr><td><input id="iDiscountP" name="discountp" type="number" step="any" min="0" placeholder=""><td>
                            <tr><td colspan="2"><label for="iBonus"><?= $this->getText('Bonus') ?></label>
                            <tr><td><input id="iBonus" name="bonus" type="number" step="any" min="0" placeholder=""><td>
                            <tr><td colspan="2"><label for="iGroup"><?= $this->getText('ClientGroup') ?></label>
                            <tr><td><input id="iGroup" name="price" type="text" placeholder=""><td><button><?= $this->getText('Add', 0, 0) ?></button>
                            <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-5" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Purchase') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iSupplierId"><?= $this->getText('Supplier') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iSupplierId" name="supplierid" type="text" placeholder="" required></span>
                            <tr><td><label for="iPrice">GTIN</label>
                            <tr><td><input id="iPrice" name="price" type="text" placeholder="">
                            <tr><td><label for="iPPriceUnit"><?= $this->getText('PriceUnit') ?></label>
                            <tr><td><select id="iPPriceUnit" name="ppriceunit">
                                        <option value="0">
                                    </select><td>
                            <tr><td><label for="iPQuantityUnit"><?= $this->getText('QuantityUnit') ?></label>
                            <tr><td><select id="iPQuantityUnit" name="pquantityunit">
                                        <option value="0">
                                    </select><td>
                            <tr><td><label for="iPTradingUnit"><?= $this->getText('TradingUnit') ?></label>
                            <tr><td><input id="iPTradingUnit" name="tradingunit" type="number" min="0" step="any" placeholder="">
                            <tr><td><label for="iPTracking"><?= $this->getText('Tracking') ?></label>
                            <tr><td><select id="iPTracking" name="tracking">
                                        <option><?= $this->getText('None') ?>
                                        <option><?= $this->getText('Lot') ?>
                                        <option><?= $this->getText('SN') ?>
                                    </select>
                            <tr><td><label for="iPInfo"><?= $this->getText('Info') ?></label>
                            <tr><td><textarea id="iPInfo" name="pinfo"></textarea>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Price') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPName"><?= $this->getText('Name') ?></label>
                            <tr><td><input id="iPName" name="pname" type="text" placeholder="">
                            <tr><td><label for="iPQuantity"><?= $this->getText('Quantity') ?></label>
                            <tr><td><input id="iPQuantity" name="quantity" type="text" placeholder="">
                            <tr><td><label for="iPrice"><?= $this->getText('Price') ?></label>
                            <tr><td><input id="iPrice" name="price" type="number" step="any" min="0" placeholder=""><td>
                            <tr><td><label for="iDiscount"><?= $this->getText('Discount') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder="">
                            <tr><td><label for="iDiscount"><?= $this->getText('DiscountP') ?></label>
                            <tr><td><input id="iDiscountP" name="discountp" type="number" step="any" min="0" placeholder="">
                            <tr><td><label for="iBonus"><?= $this->getText('Bonus') ?></label>
                            <tr><td><input id="iBonus" name="bonus" type="number" step="any" min="0" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Stock') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPVariation"><?= $this->getText('Stock') ?></label>
                            <tr><td><select id="iPVariation" name="pvariation">
                                        <option value="0">
                                    </select>
                            <tr><td><label for="iPName"><?= $this->getText('ReorderLevel') ?></label>
                            <tr><td><input id="iPName" name="pname" type="text" placeholder="">
                            <tr><td><label for="iPName"><?= $this->getText('MinimumLevel') ?></label>
                            <tr><td><input id="iPName" name="pname" type="text" placeholder="">
                            <tr><td><label for="iPName"><?= $this->getText('MaximumLevel') ?></label>
                            <tr><td><input id="iPName" name="pname" type="text" placeholder="">
                            <tr><td><label for="iPName"><?= $this->getText('Leadtime') ?></label>
                            <tr><td><input id="iPName" name="pname" type="number" min="0" step="1" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->getText('Save', 0) ?>">
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Supplier') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPName"><?= $this->getText('Name') ?></label>
                            <tr><td><input id="iPName" name="pname" type="text" placeholder="">
                            <tr><td><label for="iPName"><?= $this->getText('Description') ?></label>
                            <tr><td><textarea></textarea>
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-6" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Accounting') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td colspan="2"><label for="iACostIndicator"><?= $this->getText('CostIndicator') ?></label>
                            <tr><td><input id="iACostIndicator" name="costindicator" type="text" placeholder="">
                            <tr><td colspan="2"><label for="iAEarningIndicator"><?= $this->getText('EarningIndicator') ?></label>
                            <tr><td><input id="iAEarningIndicator" name="earningindicator" type="text" placeholder="">
                            <tr><td colspan="2"><label for="iACostIndicator"><?= $this->getText('CostCenter') ?></label>
                            <tr><td><input id="iACostIndicator" name="costindicator" type="text" placeholder="">
                            <tr><td colspan="2"><label for="iAEarningIndicator"><?= $this->getText('CostObject') ?></label>
                            <tr><td><input id="iAEarningIndicator" name="earningindicator" type="text" placeholder="">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-7" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Production') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPType"><?= $this->getText('Status') ?></label>
                            <tr><td><select id="iPType" name="ptye">
                                        <option>
                                    </select>
                            <tr><td><label for="iDiscount"><?= $this->getText('Makespan') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder="">
                            <tr><td><label for="iPType"><?= $this->getText('TimeUnit') ?></label>
                            <tr><td><select id="iPType" name="ptye">
                                        <option value="0">ms
                                        <option value="1">s
                                        <option value="2">m
                                        <option value="3">h
                                        <option value="4">d
                                    </select>
                            <tr><td><label for="iPName"><?= $this->getText('Info') ?></label>
                            <tr><td><textarea></textarea>
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-8" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('StockList') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iSource"><?= $this->getText('ID') ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iSource" name="source" type="text" placeholder=""></span>
                            <tr><td><label for="iDiscount"><?= $this->getText('Quantity') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-9" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('QM') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-10" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Packaging') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPVariation"><?= $this->getText('Container') ?></label>
                            <tr><td><select id="iPVariation" name="pvariation">
                                        <option value="0">
                                    </select>
                            <tr><td><label for="iDiscount"><?= $this->getText('Quantity') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder="">
                            <tr><td><label for="iDiscount"><?= $this->getText('GrossWeight') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder="">
                            <tr><td><label for="iDiscount"><?= $this->getText('NetWeight') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder="">
                            <tr><td><label for="iDiscount"><?= $this->getText('Width') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder="">
                            <tr><td><label for="iDiscount"><?= $this->getText('Height') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder="">
                            <tr><td><label for="iDiscount"><?= $this->getText('Length') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder="">
                            <tr><td><label for="iDiscount"><?= $this->getText('Volume') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-11" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Media') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iDiscount"><?= $this->getText('Media') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="file" multiple>
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-12" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Stock') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPVariation"><?= $this->getText('ShelfLife') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" min="0" step="1">
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Stock') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iPVariation"><?= $this->getText('Stock') ?></label>
                            <tr><td><select id="iPVariation" name="pvariation">
                                        <option value="0">
                                    </select>
                            <tr><td><label for="iPVariation"><?= $this->getText('Warehouse') ?></label>
                            <tr><td><select id="iPVariation" name="pvariation">
                                        <option value="0">
                                    </select>
                            <tr><td><label for="iPVariation"><?= $this->getText('Location') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="text"><!-- can also be empty if dynamically assigned instead of fixed -->
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-13" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Disposal') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-14" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->getText('Files') ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iDiscount"><?= $this->getText('Files') ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="file" multiple>
                            <tr><td><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-15" name="tabular-2">
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
                        <td>Creating item
                        <td><?= (new \DateTime('now'))->format('Y-m-d H:i:s') ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!--
@todo:
    maybe put a master variations selection at the beginning so that you need to change it for other variations...
    this way you will however not be able to see all at once only one at a time
    make container in packaging department that can be used by packaging for sales and purchase
    Shelf life (stock???)
    Packaging dimension+weight+units for different types (pallet, case etc.)
    Language for all variations based on variables: e.g. ${size} T-shirt in ${color}

    stock vergleichbar mit filiale
    warehouse lager in einer filiale (sd e.g. werkstatt, impla, safe, etc),
-->
