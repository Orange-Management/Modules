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
    <header><h1><?= $this->getText('Department'); ?></h1></header>
    <div class="inner">
        <form id="fDepartmentCreate" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/base}{/rootPath}{/lang}/api/organization/department'); ?>">
            <table class="layout wf-100">
                <tr><td><label for="iName"><?= $this->getText('Name'); ?></label>
                <tr><td><input type="text" name="name" id="iName" placeholder="&#xf040; R&D" required>
                <tr><td><label for="iParent"><?= $this->getText('Parent'); ?></label>
                <tr><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" name="parent" id="iParent"></span>
                <tr><td><label for="iUnit"><?= $this->getText('Unit'); ?></label>
                <tr><td><select name="unit" id="iUnit">
                        </select>
                <tr><td><label for="iDescription"><?= $this->getText('Description'); ?></label>
                <tr><td><textarea name="description" id="iDescription" placeholder="&#xf040;"></textarea>
                <tr><td><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
            </table>
        </form>
    </div>
</section>
