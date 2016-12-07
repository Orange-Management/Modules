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
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render(); ?>

<section class="box w-50">
    <header><h1><?= $this->getText('Stack'); ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td><label for="iName"><?= $this->getText('Name'); ?></label>
                <tr><td><input id="iName" name="name" type="text">
                <tr><td><label for="iType"><?= $this->getText('Type'); ?></label>
                <tr><td><select id="iType" name="type">
                            <option value=""><?= $this->getText('TAccount'); ?>
                            <option value=""><?= $this->getText('Incoming'); ?>
                            <option value=""><?= $this->getText('Outgoing'); ?>
                        </select>
                <tr><td><input name="submit" type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
            </table>
        </form>
    </div>
</section>
