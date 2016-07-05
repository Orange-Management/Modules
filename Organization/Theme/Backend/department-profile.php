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

$department = $this->getData('department');

echo $this->getData('nav')->render(); ?>

<section class="box w-33">
    <h1><?= $this->l11n->getText('Organization', 'Backend', 'Position'); ?></h1>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td><label for="iName"><?= $this->l11n->getText('Organization', 'Backend', 'Name'); ?></label>
                <tr><td><input type="text" name="name" id="iName" value="<?= $department->getName(); ?>">
                <tr><td><label for="iParent"><?= $this->l11n->getText('Organization', 'Backend', 'Parent'); ?></label>
                <tr><td><input type="text" name="parent" id="iParent" value="<?= $department->getParent(); ?>">
                <tr><td><label for="iStatus"><?= $this->l11n->getText('Organization', 'Backend', 'Status'); ?></label>
                <tr><td><select name="status" id="iStatus">
                            <option><?= $this->l11n->getText('Organization', 'Backend', 'Active'); ?>
                            <option><?= $this->l11n->getText('Organization', 'Backend', 'Inactive'); ?>
                        </select>
                <tr><td><label for="iDescription"><?= $this->l11n->getText('Organization', 'Backend', 'Description'); ?></label>
                <tr><td><textarea name="description" id="iDescription"><?= $department->getDescription(); ?></textarea>
                <tr><td><input type="submit" value="<?= $this->l11n->getText(0, 'Backend', 'Save') ?>">
            </table>
        </form>
    </div>
</section>
