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

<section class="box w-100">
    <div class="inner">
        <div id="chart" class="chart" style="width: 100%; height: 350px"></div>
    </div>
</section>

<div class="tabular-2">
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getText('Master') ?></label>
            <li><label for="c-tab-2"><?= $this->getText('Text') ?></label>
            <li><label for="c-tab-3"><?= $this->getText('Axis') ?></label>
            <li><label for="c-tab-4"><?= $this->getText('Data') ?></label>
            <li><label for="c-tab-5"><?= $this->getText('Legend') ?></label>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-1" checked>
        <div class="tab">
            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->getText('Name'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Grid'); ?></label>
                            <tr><td><select></select>
                            <tr><td><label for="iName"><?= $this->getText('Marker'); ?></label>
                            <tr><td><select></select>
                            <tr><td><label for="iName"><?= $this->getText('Hover'); ?></label>
                            <tr><td><select></select>
                            <tr><td><label for="iName"><?= $this->getText('Thickness'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Color'); ?></label>
                            <tr><td><select></select>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->getText('ShowData'); ?></label></span>
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
                            <tr><td><label for="iName"><?= $this->getText('Title'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Size'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Position'); ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->getText('Subtitle'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Size'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Position'); ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->getText('Footer'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Size'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Position'); ?></label>
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
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->getText('Visible'); ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->getText('ShowAxis'); ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->getText('ShowTicks'); ?></label></span>
                            <tr><td><label for="iName"><?= $this->getText('Minimum'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Maximum'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Steps'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Label'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Size'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Position'); ?></label>
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
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->getText('Visible'); ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->getText('ShowAxis'); ?></label></span>
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->getText('ShowTicks'); ?></label></span>
                            <tr><td><label for="iName"><?= $this->getText('Minimum'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Maximum'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Steps'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Label'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Size'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName"><?= $this->getText('Position'); ?></label>
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
                            <tr><td><label for="iName"><?= $this->getText('Info'); ?></label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName">X</label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><label for="iName">Y</label>
                            <tr><td><input type="text" id="iName">
                            <tr><td><button><?= $this->getText('Add', 0, 0); ?></button>
                        </table>
                    </form>
                </div>
            </section>

            <section class="box w-50 floatLeft">
                <div class="inner">
                    <form>
                        <table class="wf-100">
                            <tr><td><label for="iName"><?= $this->getText('Data'); ?></label>
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
                            <tr><td><span class="check"><input type="checkbox"><label><?= $this->getText('Visible'); ?></label></span>
                            <tr><td><label for="iName"><?= $this->getText('Position'); ?></label>
                            <tr><td><select></select>
                        </table>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
