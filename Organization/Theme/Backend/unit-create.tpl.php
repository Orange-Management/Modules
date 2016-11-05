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

<section class="box w-33">
    <header><h1><?= $this->getText('Unit'); ?></h1></header>
    <div class="inner">
        <form method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/base}{/rootPath}{/lang}/api/organization/unit'); ?>">
            <table class="layout wf-100">
                <tr><td><label for="iName"><?= $this->getText('Name'); ?></label>
                <tr><td><input type="text" name="name" id="iName" placeholder="&#xf040; Orange Management" required>
                <tr><td><label for="iParent"><?= $this->getText('Parent'); ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" name="parent" id="iParent"></span>
                <tr><td><label for="iStatus"><?= $this->getText('Status'); ?></label>
                <tr><td><select name="status" id="iStatus">
                            <option value="<?= \Modules\Organization\Models\Status::ACTIVE; ?>"><?= $this->getText('Active'); ?>
                            <option value="<?= \Modules\Organization\Models\Status::INACTIVE; ?>"><?= $this->getText('Inactive'); ?>
                            </select>
                <tr><td><label for="iDescription"><?= $this->getText('Description'); ?></label>
                <tr><td><textarea name="description" id="iDescription" placeholder="&#xf040;"></textarea>
                <tr><td><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
            </table>
        </form>
    </div>
</section>
