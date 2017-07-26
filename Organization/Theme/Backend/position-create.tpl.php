<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Position') ?></h1></header>
            <div class="inner">
                <form id="fPositionCreate" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/base}{/rootPath}{/lang}/api/organization/position'); ?>">
                    <table class="layout wf-100">
                        <tr><td><label for="iName"><?= $this->getHtml('Name') ?></label>
                        <tr><td><input type="text" name="name" id="iName" placeholder="&#xf040; Orange Management" required>
                        <tr><td><label for="iParent"><?= $this->getHtml('Parent') ?></label>
                        <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" name="parent" id="iParent"></span>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status') ?></label>
                        <tr><td><select name="status" id="iStatus">
                                    <option value="<?= htmlspecialchars(\Modules\Organization\Models\Status::ACTIVE, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('Active') ?>
                                    <option value="<?= htmlspecialchars(\Modules\Organization\Models\Status::INACTIVE, ENT_COMPAT, 'utf-8'); ?>"><?= $this->getHtml('Inactive') ?>
                                    </select>
                        <tr><td><label for="iDescription"><?= $this->getHtml('Description') ?></label>
                        <tr><td><textarea name="description" id="iDescription" placeholder="&#xf040;"></textarea>
                        <tr><td><input type="submit" value="<?= $this->getHtml('Create', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>
