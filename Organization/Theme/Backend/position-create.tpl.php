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
    <h1><?= $this->l11n->lang['Organization']['Position']; ?></h1>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td><label for="iName"><?= $this->l11n->lang['Organization']['Name']; ?></label>
                <tr><td><input type="text" name="name" id="iName" placeholder="&#xf040; Orange Management" required>
                <tr><td><label for="iParent"><?= $this->l11n->lang['Organization']['Parent']; ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" name="parent" id="iParent"></span>
                <tr><td><label for="iStatus"><?= $this->l11n->lang['Organization']['Status']; ?></label>
                <tr><td><select name="status" id="iStatus">
                            <option><?= $this->l11n->lang['Organization']['Active']; ?>
                            <option><?= $this->l11n->lang['Organization']['Inactive']; ?>
                            </select>
                <tr><td><label for="iDescription"><?= $this->l11n->lang['Organization']['Description']; ?></label>
                <tr><td><textarea name="description" id="iDescription" placeholder="&#xf040;"></textarea>
                <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Create'] ?>">
            </table>
        </form>
    </div>
</section>
