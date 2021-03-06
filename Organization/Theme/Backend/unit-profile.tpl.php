<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Organization
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View                $this
 * @var \Modules\Organization\Models\Unit $unit;
 */
$unit = $this->getData('unit');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="portlet">
            <form id="iUnit" action="<?= UriFactory::build('{/api}organization/unit') ?>" method="post">
                <div class="portlet-head"><?= $this->getHtml('Unit') ?></div>
                <div class="portlet-body">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tr><td><label for="iName"><?= $this->getHtml('Name') ?></label>
                        <tr><td><input type="text" name="name" id="iName" value="<?= $this->printHtml($unit->getName()); ?>">
                        <tr><td><label for="iParent"><?= $this->getHtml('Parent') ?></label>
                        <tr><td><?= $this->getData('unit-selector')->render('iParent', false); ?>
                        <tr><td><label for="iStatus"><?= $this->getHtml('Status') ?></label>
                        <tr><td><select name="status" id="iStatus">
                                    <option value="<?= $this->printHtml(\Modules\Organization\Models\Status::ACTIVE); ?>"<?= \Modules\Organization\Models\Status::ACTIVE === $unit->getStatus() ? ' selected' : ''; ?>><?= $this->getHtml('Active') ?>
                                    <option value="<?= $this->printHtml(\Modules\Organization\Models\Status::INACTIVE); ?>"<?= \Modules\Organization\Models\Status::INACTIVE === $unit->getStatus() ? ' selected' : ''; ?>><?= $this->getHtml('Inactive') ?>
                                </select>
                        <tr><td><?= $this->getData('editor')->render('unit-editor'); ?>
                        <tr><td><?= $this->getData('editor')->getData('text')->render(
                            'unit-editor',
                            'description',
                            'iUnit',
                            $unit->getDescriptionRaw(),
                            $unit->getDescription()
                        ); ?>
                    </table>
                </div>
                <div class="portlet-foot">
                    <input id="iUnitId" name="id" type="hidden" value="<?= (int) $unit->getId(); ?>">
                    <input id="iSubmit" name="submit" type="submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->getData('unit-selector')->getData('unit-selector-popup')->render(); ?>
