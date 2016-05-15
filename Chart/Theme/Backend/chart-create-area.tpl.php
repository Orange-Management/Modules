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

<section class="box w-100">
    <div class="inner">
        <div id="chart" class="chart" style="width: 100%; height: 350px"></div>
    </div>
</section>

<div class="tabular-2">
    <section class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->l11n->lang['Chart']['Master'] ?></label>
            <li><label for="c-tab-2"><?= $this->l11n->lang['Chart']['Text'] ?></label>
            <li><label for="c-tab-3"><?= $this->l11n->lang['Chart']['Axis'] ?></label>
            <li><label for="c-tab-4"><?= $this->l11n->lang['Chart']['Data'] ?></label>
            <li><label for="c-tab-5"><?= $this->l11n->lang['Chart']['Legend'] ?></label>
        </ul>
    </section>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-1" checked>
        <div class="tab">
            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Name']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Grid']; ?></label>
                            <tr><td><select></select>
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Marker']; ?></label>
                            <tr><td><select></select>
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Hover']; ?></label>
                            <tr><td><select></select>
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Thickness']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Color']; ?></label>
                            <tr><td><select></select>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->lang['Chart']['ShowData']; ?></label></span>
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-1">
        <div class="tab">
            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Title']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Size']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Position']; ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Subtitle']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Size']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Position']; ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Footer']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Size']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Position']; ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-3" name="tabular-1">
        <div class="tab">
            <section class="box w-50 floatLeft">
                <h1>X</h1>
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->lang['Chart']['Visible']; ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->lang['Chart']['ShowAxis']; ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->lang['Chart']['ShowTicks']; ?></label></span>
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Minimum']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Maximum']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Steps']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Label']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Size']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Position']; ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <h1>Y</h1>
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->lang['Chart']['Visible']; ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->lang['Chart']['ShowAxis']; ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->lang['Chart']['ShowTicks']; ?></label></span>
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Minimum']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Maximum']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Steps']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Label']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Size']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Position']; ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-4" name="tabular-1">
        <div class="tab">
            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Info']; ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName">X</label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName">Y</label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><button><?= $this->l11n->lang[0]['Add']; ?></button>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Data']; ?></label>
                            <tr><td><textarea></textarea>
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-5" name="tabular-1">
        <div class="tab">
            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->lang['Chart']['Visible']; ?></label></span>
                            <tr><td><label for="iName"><?= $this->l11n->lang['Chart']['Position']; ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
