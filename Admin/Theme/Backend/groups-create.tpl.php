<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Admin\Template\Backend
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */

/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Group'); ?></h1></header>
            <div class="inner">
                <form id="fGroupCreate" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/group'); ?>" method="put">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tbody>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status'); ?></label>
                        <tr><td>
                                <select id="iStatus" name="status">
                                    <option value="<?= $this->printHtml(\phpOMS\Account\GroupStatus::ACTIVE); ?>" selected><?= $this->getHtml('Active'); ?>
                                    <option value="<?= $this->printHtml(\phpOMS\Account\GroupStatus::INACTIVE); ?>"><?= $this->getHtml('Inactive'); ?>
                                </select>
                        <tr><td><label for="iGname"><?= $this->getHtml('Name'); ?></label>
                        <tr><td><input id="iGname" name="name" type="text" placeholder="&#xf0c0; Guest" required>
                        <tr><td><?= $this->getData('editor')->render('group-editor'); ?>
                        <tr><td><?= $this->getData('editor')->getData('text')->render('group-editor', 'description', 'fGroupCreate'); ?>
                        <tr><td><input type="submit" id="iCreate" name="create" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>