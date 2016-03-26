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
    <section class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->l11n->lang['SupplierManagement']['Master'] ?></label></li>
            <li><label for="c-tab-2"><?= $this->l11n->lang['SupplierManagement']['Contact'] ?></label></li>
            <li><label for="c-tab-3"><?= $this->l11n->lang['SupplierManagement']['Addresses'] ?></label></li>
            <li><label for="c-tab-4"><?= $this->l11n->lang['SupplierManagement']['PaymentTerm'] ?></label></li>
            <li><label for="c-tab-5"><?= $this->l11n->lang['SupplierManagement']['Payment'] ?></label></li>
            <li><label for="c-tab-6"><?= $this->l11n->lang['SupplierManagement']['Files'] ?></label></li>
        </ul>
    </section>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <section class="box w-33 floatLeft">
                <h1><?= $this->l11n->lang['SupplierManagement']['Supplier'] ?></h1>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iId"><?= $this->l11n->lang[0]['ID']; ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="number" id="iId" min="1" name="id" required></span>
                            <tr><td><label for="iName1"><?= $this->l11n->lang['SupplierManagement']['Name1']; ?></label>
                            <tr><td><input type="text" id="iName1" name="name1" placeholder="&#xf040;" required>
                            <tr><td><label for="iName2"><?= $this->l11n->lang['SupplierManagement']['Name2']; ?></label>
                            <tr><td><input type="text" id="iName2" name="name2" placeholder="&#xf040;">
                            <tr><td><label for="iName3"><?= $this->l11n->lang['SupplierManagement']['Name3']; ?></label>
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
                <h1><?= $this->l11n->lang['SupplierManagement']['Contact'] ?></h1>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iCType"><?= $this->l11n->lang['SupplierManagement']['Type']; ?></label>
                            <tr><td><select id="iCType" name="actype">
                                        <option><?= $this->l11n->lang['SupplierManagement']['Email']; ?>
                                        <option><?= $this->l11n->lang['SupplierManagement']['Fax']; ?>
                                        <option><?= $this->l11n->lang['SupplierManagement']['Phone']; ?>
                                    </select>
                            <tr><td><label for="iCStype"><?= $this->l11n->lang['SupplierManagement']['Subtype']; ?></label>
                            <tr><td><select id="iCStype" name="acstype">
                                        <option><?= $this->l11n->lang['SupplierManagement']['Office']; ?>
                                        <option><?= $this->l11n->lang['SupplierManagement']['Sales']; ?>
                                        <option><?= $this->l11n->lang['SupplierManagement']['Purchase']; ?>
                                        <option><?= $this->l11n->lang['SupplierManagement']['Accounting']; ?>
                                        <option><?= $this->l11n->lang['SupplierManagement']['Support']; ?>
                                    </select>
                            <tr><td><label for="iCInfo"><?= $this->l11n->lang['SupplierManagement']['Info']; ?></label>
                            <tr><td><input type="text" id="iCInfo" name="cinfo">
                            <tr><td><label for="iCData"><?= $this->l11n->lang['SupplierManagement']['Contact']; ?></label>
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
                <h1><?= $this->l11n->lang['SupplierManagement']['Address'] ?></h1>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iAType"><?= $this->l11n->lang['SupplierManagement']['Type']; ?></label>
                            <tr><td><select id="iAType" name="atype">
                                        <option><?= $this->l11n->lang['SupplierManagement']['Default']; ?>
                                        <option><?= $this->l11n->lang['SupplierManagement']['Delivery']; ?>
                                        <option><?= $this->l11n->lang['SupplierManagement']['Invoice']; ?>
                                    </select>
                            <tr><td><label for="iAddress"><?= $this->l11n->lang['SupplierManagement']['Address']; ?></label>
                            <tr><td><input type="text" id="iAddress" name="address">
                            <tr><td><label for="iZip"><?= $this->l11n->lang['SupplierManagement']['Zip']; ?></label>
                            <tr><td><input type="text" id="iZip" name="zip">
                            <tr><td><label for="iCountry"><?= $this->l11n->lang['SupplierManagement']['Country']; ?></label>
                            <tr><td><input type="text" id="iCountry" name="country">
                            <tr><td><label for="iAInfo"><?= $this->l11n->lang['SupplierManagement']['Info']; ?></label>
                            <tr><td><input type="text" id="iAInfo" name="ainfo">
                            <tr><td><span class="check"><input type="checkbox" id="iDefault" name="default" checked><label for="iDefault"><?= $this->l11n->lang['SupplierManagement']['IsDefault']; ?></label></span>
                            <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-4" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <h1><?= $this->l11n->lang['SupplierManagement']['PaymentTerm'] ?></h1>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iSource"><?= $this->l11n->lang[0]['ID'] ?></label>
                            <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input id="iSource" name="source" type="text" placeholder=""></span>
                            <tr><td><label for="iSegment"><?= $this->l11n->lang['SupplierManagement']['Segment'] ?></label>
                            <tr><td><input id="iSegment" name="segment" type="text" placeholder="">
                            <tr><td><label for="iProductgroup"><?= $this->l11n->lang['SupplierManagement']['Productgroup'] ?></label>
                            <tr><td><input id="iProductgroup" name="productgroup" type="text" placeholder="">
                            <tr><td><label for="iGroup"><?= $this->l11n->lang['SupplierManagement']['Group'] ?></label>
                            <tr><td><input id="iGroup" name="group" type="text" placeholder="">
                            <tr><td><label for="iArticlegroup"><?= $this->l11n->lang['SupplierManagement']['Articlegroup'] ?></label>
                            <tr><td><input id="iArticlegroup" name="articlegroup" type="text" placeholder="">
                            <tr><td><label for="iTerm"><?= $this->l11n->lang['SupplierManagement']['Type'] ?></label>
                            <tr><td><select id="iTerm" name="term" required>
                                        <option>
                                    </select>
                            <tr><td><span class="check"><input type="checkbox" id="iFreightage" name="freightage"><label for="iFreightage"><?= $this->l11n->lang['SupplierManagement']['Freightage'] ?></label></span>
                            <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-5" name="tabular-2">
        <div class="tab">
            <section class="box w-33 floatLeft">
                <h1><?= $this->l11n->lang['SupplierManagement']['Payment'] ?></h1>
                <div class="inner">
                    <form>
                        <table class="layout w-100">
                            <tr><td><label for="iACType"><?= $this->l11n->lang['SupplierManagement']['Type']; ?></label>
                            <tr><td><select id="iACType" name="actype">
                                        <option><?= $this->l11n->lang['SupplierManagement']['Wire']; ?>
                                        <option><?= $this->l11n->lang['SupplierManagement']['Creditcard']; ?>
                                    </select>
                            <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->lang[0]['Add'] ?>">
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-6" name="tabular-2">
        <div class="tab">
        </div>
    </div>
</div>
