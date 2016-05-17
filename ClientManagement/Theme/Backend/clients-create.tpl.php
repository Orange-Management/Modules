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
            <li><label for="c-tab-1"><?= $this->l11n->lang['ClientManagement']['Master'] ?></label></li>
            <li><label for="c-tab-2"><?= $this->l11n->lang['ClientManagement']['Contact'] ?></label></li>
            <li><label for="c-tab-3"><?= $this->l11n->lang['ClientManagement']['Addresses'] ?></label></li>
            <li><label for="c-tab-4"><?= $this->l11n->lang['ClientManagement']['PaymentTerm'] ?></label></li>
            <li><label for="c-tab-5"><?= $this->l11n->lang['ClientManagement']['Payment'] ?></label></li>
            <li><label for="c-tab-6"><?= $this->l11n->lang['ClientManagement']['Prices'] ?></label></li>
            <li><label for="c-tab-7"><?= $this->l11n->lang['ClientManagement']['AreaManager'] ?></label></li>
            <li><label for="c-tab-8"><?= $this->l11n->lang['ClientManagement']['Files'] ?></label></li>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->l11n->lang['ClientManagement']['Client'] ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iId"><?= $this->l11n->lang[0]['ID']; ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="number" id="iId" min="1" name="id" required></span>
                            <tr><td><label for="iName1"><?= $this->l11n->lang['ClientManagement']['Name1']; ?></label>
                            <tr><td><input type="text" id="iName1" name="name1" placeholder="&#xf040;" required>
                            <tr><td><label for="iName2"><?= $this->l11n->lang['ClientManagement']['Name2']; ?></label>
                            <tr><td><input type="text" id="iName2" name="name2" placeholder="&#xf040;">
                            <tr><td><label for="iName3"><?= $this->l11n->lang['ClientManagement']['Name3']; ?></label>
                            <tr><td><input type="text" id="iName3" name="name3" placeholder="&#xf040;">
                            <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->lang[0]['Create'] ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->l11n->lang['ClientManagement']['Contact'] ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iCType"><?= $this->l11n->lang['ClientManagement']['Type']; ?></label>
                            <tr><td><select id="iCType" name="actype">
                                        <option><?= $this->l11n->lang['ClientManagement']['Email']; ?>
                                        <option><?= $this->l11n->lang['ClientManagement']['Fax']; ?>
                                        <option><?= $this->l11n->lang['ClientManagement']['Phone']; ?>
                                    </select>
                            <tr><td><label for="iCStype"><?= $this->l11n->lang['ClientManagement']['Subtype']; ?></label>
                            <tr><td><select id="iCStype" name="acstype">
                                        <option><?= $this->l11n->lang['ClientManagement']['Office']; ?>
                                        <option><?= $this->l11n->lang['ClientManagement']['Sales']; ?>
                                        <option><?= $this->l11n->lang['ClientManagement']['Purchase']; ?>
                                        <option><?= $this->l11n->lang['ClientManagement']['Accounting']; ?>
                                        <option><?= $this->l11n->lang['ClientManagement']['Support']; ?>
                                    </select>
                            <tr><td><label for="iCInfo"><?= $this->l11n->lang['ClientManagement']['Info']; ?></label>
                            <tr><td><input type="text" id="iCInfo" name="cinfo">
                            <tr><td><label for="iCData"><?= $this->l11n->lang['ClientManagement']['Contact']; ?></label>
                            <tr><td><input type="text" id="iCData" name="cdata">
                            <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-3" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->l11n->lang['ClientManagement']['Address'] ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iAType"><?= $this->l11n->lang['ClientManagement']['Type']; ?></label>
                            <tr><td><select id="iAType" name="atype">
                                        <option><?= $this->l11n->lang['ClientManagement']['Default']; ?>
                                        <option><?= $this->l11n->lang['ClientManagement']['Delivery']; ?>
                                        <option><?= $this->l11n->lang['ClientManagement']['Invoice']; ?>
                                    </select>
                            <tr><td><label for="iAddress"><?= $this->l11n->lang['ClientManagement']['Address']; ?></label>
                            <tr><td><input type="text" id="iAddress" name="address">
                            <tr><td><label for="iZip"><?= $this->l11n->lang['ClientManagement']['Zip']; ?></label>
                            <tr><td><input type="text" id="iZip" name="zip">
                            <tr><td><label for="iCountry"><?= $this->l11n->lang['ClientManagement']['Country']; ?></label>
                            <tr><td><input type="text" id="iCountry" name="country">
                            <tr><td><label for="iAInfo"><?= $this->l11n->lang['ClientManagement']['Info']; ?></label>
                            <tr><td><input type="text" id="iAInfo" name="ainfo">
                            <tr><td><span class="check"><input type="checkbox" id="iDefault" name="default" checked><label for="iDefault"><?= $this->l11n->lang['ClientManagement']['IsDefault']; ?></label></span>
                            <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-4" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->l11n->lang['ClientManagement']['PaymentTerm'] ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iSource"><?= $this->l11n->lang[0]['ID'] ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iSource" name="source" type="text" placeholder=""></span>
                            <tr><td><label for="iSegment"><?= $this->l11n->lang['ClientManagement']['Segment'] ?></label>
                            <tr><td><input id="iSegment" name="segment" type="text" placeholder="">
                            <tr><td><label for="iProductgroup"><?= $this->l11n->lang['ClientManagement']['Productgroup'] ?></label>
                            <tr><td><input id="iProductgroup" name="productgroup" type="text" placeholder="">
                            <tr><td><label for="iGroup"><?= $this->l11n->lang['ClientManagement']['Group'] ?></label>
                            <tr><td><input id="iGroup" name="group" type="text" placeholder="">
                            <tr><td><label for="iArticlegroup"><?= $this->l11n->lang['ClientManagement']['Articlegroup'] ?></label>
                            <tr><td><input id="iArticlegroup" name="articlegroup" type="text" placeholder="">
                            <tr><td><label for="iTerm"><?= $this->l11n->lang['ClientManagement']['Type'] ?></label>
                            <tr><td><select id="iTerm" name="term" required>
                                        <option>
                                    </select>
                            <tr><td><span class="check"><input type="checkbox" id="iFreightage" name="freightage"><label for="iFreightage"><?= $this->l11n->lang['ClientManagement']['Freightage'] ?></label></span>
                            <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-5" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->l11n->lang['ClientManagement']['Payment'] ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iACType"><?= $this->l11n->lang['ClientManagement']['Type']; ?></label>
                            <tr><td><select id="iACType" name="actype">
                                        <option><?= $this->l11n->lang['ClientManagement']['Wire']; ?>
                                        <option><?= $this->l11n->lang['ClientManagement']['Creditcard']; ?>
                                    </select>
                            <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-6" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->l11n->lang['ClientManagement']['Price'] ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td colspan="2"><label for="iPType"><?= $this->l11n->lang['ClientManagement']['Type'] ?></label>
                            <tr><td><select id="iPType" name="ptye">
                                        <option>
                                    </select><td>
                            <tr><td><label for="iSource"><?= $this->l11n->lang[0]['ID'] ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iSource" name="source" type="text" placeholder=""></span>
                            <tr><td><label for="iSegment"><?= $this->l11n->lang['ClientManagement']['Segment'] ?></label>
                            <tr><td><input id="iSegment" name="segment" type="text" placeholder="">
                            <tr><td><label for="iProductgroup"><?= $this->l11n->lang['ClientManagement']['Productgroup'] ?></label>
                            <tr><td><input id="iProductgroup" name="productgroup" type="text" placeholder="">
                            <tr><td><label for="iGroup"><?= $this->l11n->lang['ClientManagement']['Group'] ?></label>
                            <tr><td><input id="iGroup" name="group" type="text" placeholder="">
                            <tr><td><label for="iArticlegroup"><?= $this->l11n->lang['ClientManagement']['Articlegroup'] ?></label>
                            <tr><td><input id="iArticlegroup" name="articlegroup" type="text" placeholder="">
                            <tr><td><label for="iPQuantity"><?= $this->l11n->lang['ClientManagement']['Quantity'] ?></label>
                            <tr><td><input id="iPQuantity" name="quantity" type="text" placeholder=""><td>
                            <tr><td><label for="iPrice"><?= $this->l11n->lang['ClientManagement']['Price'] ?></label>
                            <tr><td><input id="iPrice" name="price" type="number" step="any" min="0" placeholder=""><td>
                            <tr><td><label for="iDiscount"><?= $this->l11n->lang['ClientManagement']['Discount'] ?></label>
                            <tr><td><input id="iDiscount" name="discount" type="number" step="any" min="0" placeholder=""><td>
                            <tr><td><label for="iDiscount"><?= $this->l11n->lang['ClientManagement']['DiscountP'] ?></label>
                            <tr><td><input id="iDiscountP" name="discountp" type="number" step="any" min="0" placeholder=""><td>
                            <tr><td><label for="iBonus"><?= $this->l11n->lang['ClientManagement']['Bonus'] ?></label>
                            <tr><td><input id="iBonus" name="bonus" type="number" step="any" min="0" placeholder=""><td>
                            <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-7" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <header><h1><?= $this->l11n->lang['ClientManagement']['AreaManager'] ?></h1></header>
                <div class="inner">
                    <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/...'); ?>" method="post">
                        <table class="layout wf-100">
                            <tbody>
                            <tr><td><label for="iManager"><?= $this->l11n->lang['ClientManagement']['AreaManager'] ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iManager" name="source" type="text" placeholder=""></span>
                            <tr><td><label for="iSource"><?= $this->l11n->lang[0]['ID'] ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iSource" name="source" type="text" placeholder=""></span>
                            <tr><td><label for="iSegment"><?= $this->l11n->lang['ClientManagement']['Segment'] ?></label>
                            <tr><td><input id="iSegment" name="segment" type="text" placeholder="">
                            <tr><td><label for="iProductgroup"><?= $this->l11n->lang['ClientManagement']['Productgroup'] ?></label>
                            <tr><td><input id="iProductgroup" name="productgroup" type="text" placeholder="">
                            <tr><td><label for="iGroup"><?= $this->l11n->lang['ClientManagement']['Group'] ?></label>
                            <tr><td><input id="iGroup" name="group" type="text" placeholder="">
                            <tr><td><label for="iArticlegroup"><?= $this->l11n->lang['ClientManagement']['Articlegroup'] ?></label>
                            <tr><td><input id="iArticlegroup" name="articlegroup" type="text" placeholder="">
                            <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-8" name="tabular-2">
        <div class="tab">
        </div>
    </div>
</div>
