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
echo $this->getData('nav')->render(); ?>

<section class="box w-50">
    <header><h1><?= $this->l11n->lang['Accounting']['CostObject']; ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td><label for="iId"><?= $this->l11n->lang[0]['ID']; ?></label>
                <tr><td><input type="text" id="iId" name="id">
                <tr><td><label for="iName"><?= $this->l11n->lang['Accounting']['Name']; ?></label>
                <tr><td><input type="text" id="iName" name="name">
                <tr><td><label for="iParent"><?= $this->l11n->lang['Accounting']['Parent']; ?></label>
                <tr><td><input type="text" id="iParent" name="parent">
                <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Create']; ?>">
            </table>
        </form>
    </div>
</section>
