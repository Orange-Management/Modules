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
    <header><h1><?= $this->getText('Department'); ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td><label for="iName"><?= $this->getText('Name'); ?></label>
                <tr><td><input type="text" name="name" id="iName" value="<?= $department->getName(); ?>">
                <tr><td><label for="iParent"><?= $this->getText('Parent'); ?></label>
                <tr><td><input type="text" name="parent" id="iParent" value="<?= $department->getParent(); ?>">
                <tr><td><label for="iStatus"><?= $this->getText('Status'); ?></label>
                <tr><td><select name="status" id="iStatus">
                            <option><?= $this->getText('Active'); ?>
                            <option><?= $this->getText('Inactive'); ?>
                        </select>
                <tr><td><label for="iDescription"><?= $this->getText('Description'); ?></label>
                <tr><td><textarea name="description" id="iDescription"><?= $department->getDescription(); ?></textarea>
                <tr><td><input type="submit" value="<?= $this->getText('Save', 0) ?>">
            </table>
        </form>
    </div>
</section>
