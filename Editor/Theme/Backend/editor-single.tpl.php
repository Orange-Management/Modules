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
$doc = $this->getData('doc');
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <form id="fEditor" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}editor?{?}&csrf={$CSRF}'); ?>">
                    <div class="ipt-wrap">
                        <div class="ipt-first"><input name="title" type="text" class="wf-100" value="<?= $doc->getTitle(); ?>"></div>
                        <div class="ipt-second"><input type="submit" value="<?= $this->getHtml('Save') ?>"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <?= $this->getData('editor')->render('editor'); ?>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="box col-xs-12">
        <?= $this->getData('editor')->getData('text')->render(
            'editor',
            'plain',
            'fEditor',
            $doc->getPlain(),
            $doc->getContent()
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner">
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
        </section>
    </div>
</div>
