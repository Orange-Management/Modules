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

$unit = $this->getData('unit');

echo $this->getData('nav')->render(); ?>

<section class="box w-33">
    <header><h1><?= $this->l11n->getText('Organization', 'Backend', 'Unit'); ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td><label for="iName"><?= $this->l11n->getText('Organization', 'Backend', 'Name'); ?></label>
                <tr><td><input type="text" name="name" id="iName" value="<?= $unit->getName(); ?>">
                <tr><td><label for="iParent"><?= $this->l11n->getText('Organization', 'Backend', 'Parent'); ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" name="parent" id="iParent" value="<?= $unit->getParent(); ?>" required></span>
                <tr><td><label for="iStatus"><?= $this->l11n->getText('Organization', 'Backend', 'Status'); ?></label>
                <tr><td><select name="status" id="iStatus">
                            <option><?= $this->l11n->getText('Organization', 'Backend', 'Active'); ?>
                            <option><?= $this->l11n->getText('Organization', 'Backend', 'Inactive'); ?>
                        </select>
                <tr><td><label for="iDescription"><?= $this->l11n->getText('Organization', 'Backend', 'Description'); ?></label>
                <tr><td><textarea name="description" id="iDescription"><?= $unit->getDescription(); ?></textarea>
                <tr><td><input type="submit" value="<?= $this->l11n->getText(0, 'Backend', 'Save') ?>">
            </table>
        </form>
    </div>
</section>
