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
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->l11n->getText('Chart', 'Master') ?></label>
            <li><label for="c-tab-2"><?= $this->l11n->getText('Chart', 'Text') ?></label>
            <li><label for="c-tab-3"><?= $this->l11n->getText('Chart', 'Axis') ?></label>
            <li><label for="c-tab-4"><?= $this->l11n->getText('Chart', 'Data') ?></label>
            <li><label for="c-tab-5"><?= $this->l11n->getText('Chart', 'Legend') ?></label>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-1" checked>
        <div class="tab">
            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Name'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Grid'); ?></label>
                            <tr><td><select></select>
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Marker'); ?></label>
                            <tr><td><select></select>
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Hover'); ?></label>
                            <tr><td><select></select>
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Thickness'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Color'); ?></label>
                            <tr><td><select></select>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->getText('Chart', 'ShowData'); ?></label></span>
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
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Title'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Size'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Position'); ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Subtitle'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Size'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Position'); ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Footer'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Size'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Position'); ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>
        </div>
        <input type="radio" id="c-tab-3" name="tabular-1">
        <div class="tab">
            <section class="box w-50 floatLeft">
                <header><h1>X</h1></header>
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->getText('Chart', 'Visible'); ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->getText('Chart', 'ShowAxis'); ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->getText('Chart', 'ShowTicks'); ?></label></span>
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Minimum'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Maximum'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Steps'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Label'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Size'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Position'); ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <header><h1>Y</h1></header>
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->getText('Chart', 'Visible'); ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->getText('Chart', 'ShowAxis'); ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->getText('Chart', 'ShowTicks'); ?></label></span>
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Minimum'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Maximum'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Steps'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Label'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Size'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Position'); ?></label>
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
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Info'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName">X</label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName">Y</label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><button><?= $this->l11n->getText(0, 'Add'); ?></button>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Data'); ?></label>
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
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->l11n->getText('Chart', 'Visible'); ?></label></span>
                            <tr><td><label for="iName"><?= $this->l11n->getText('Chart', 'Position'); ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
