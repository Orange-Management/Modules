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
        <form>
            <input type="text" class="wf-100">
        </form>
    </div>
</section>

<section class="box w-100">
    <div class="tabular">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->l11n->lang['Draw']['Start'] ?></label>
            <li><label for="c-tab-2"><?= $this->l11n->lang['Draw']['Layout'] ?></label>
        </ul>
        <div class="tab-content">
            <input type="radio" id="c-tab-1" name="tabular-1" checked>
            <div class="tab">
                <ul class="h-list">
                    <li><i class="fa fa-lg fa-floppy-o"></i>
                    <li><i class="fa fa-lg fa-cloud-download"></i>
                    <li><i class="fa fa-lg fa-undo"></i>
                    <li><i class="fa fa-lg fa-repeat"></i>
                    <li><i class="fa fa-lg fa-pencil"></i>
                    <li><i class="fa fa-lg fa-paint-brush"></i>
                    <li><i class="fa fa-lg fa-eraser"></i>
                    <li><i class="fa fa-lg fa-minus"></i>
                    <li><i class="fa fa-lg fa-square-o"></i>
                    <li><i class="fa fa-lg fa-circle-thin"></i>
                    <li><i class="fa fa-lg fa-tint"></i>
                    <li><i class="fa fa-lg fa-bars"></i>
                    <li><i class="fa fa-lg fa-i-cursor"></i>
                    <li><i class="fa fa-lg fa-text-height"></i>
                </ul>
            </div>
            <input type="radio" id="c-tab-2" name="tabular-1">
            <div class="tab">
            </div>
        </div>
    </div>
</section>

<div class="m-draw">
    <section class="box w-100" style="height: 30%;">
        <div class="inner">
            <canvas></canvas>
        </div>
    </section>
</div>

<section class="box w-100">
    <div class="inner">
        <form>
            <table class="layout">
                <tr><td colspan="2"><label><?= $this->l11n->lang['Draw']['Permission'] ?></label>
                <tr><td><select>
                            <option>
                        </select>
                <tr><td colspan="2"><label><?= $this->l11n->lang['Draw']['GroupUser'] ?></label>
                <tr><td><input id="iPermission" name="group" type="text" placeholder="&#xf084;"><td><button><?= $this->l11n->lang[0]['Add'] ?></button>
            </table>
        </form>
    </div>
</section>