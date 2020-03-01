<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Editor
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View $this
 */

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-8">
        <div class="portlet">
            <div class="portlet-body">
                <form id="fEditor" method="PUT" action="<?= \phpOMS\Uri\UriFactory::build('{/api}editor?{?}&csrf={$CSRF}'); ?>">
                    <div class="ipt-wrap">
                        <div class="ipt-first"><input name="title" type="text" class="wf-100"></div>
                        <div class="ipt-second"><input type="submit" value="<?= $this->getHtml('Save') ?>"></div>
                    </div>
                </form>
            </div>
        </div>

        <div class="portlet">
            <div class="portlet-body">
                <?= $this->getData('editor')->render('editor'); ?>
            </div>
        </div>

        <div class="box">
            <?= $this->getData('editor')->getData('text')->render('editor', 'plain', 'fEditor'); ?>
        </div>
    </div>

    <div class="col-xs-12 col-md-4">
        <div class="portlet">
            <div class="portlet-body">
                <?= $this->getData('tagSelector')->render('iTag', 'tag', false); ?>
            </div>
        </div>

        <div class="portlet">
            <div class="portlet-body">
                <form>
                    <table class="layout">
                        <tr><td colspan="2"><label><?= $this->getHtml('Permission'); ?></label>
                        <tr><td><select>
                                    <option>
                                </select>
                        <tr><td colspan="2"><label><?= $this->getHtml('GroupUser'); ?></label>
                        <tr><td><input id="iPermission" name="group" type="text" placeholder="&#xf084;"><td><button><?= $this->getHtml('Add'); ?></button>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
