<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Marketing
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View $this
 */

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Promotion'); ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('{/api}marketing/promotion'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iTitle"><?= $this->getHtml('Type'); ?></label>
                        <tr><td colspan="2"><select></select>
                        <tr><td colspan="2"><label for="iBudget"><?= $this->getHtml('Title') ?></label>
                        <tr><td colspan="2"><input type="text">
                        <tr><td colspan="2"><label for="iBudget"><?= $this->getHtml('Description') ?></label>
                        <tr><td colspan="2"><textarea></textarea>
                        <tr><td><label for="iTitle"><?= $this->getHtml('Start') ?></label><td><label for="iTitle"><?= $this->getHtml('End') ?></label>
                        <tr><td><input type="datetime-local"><td><input type="datetime-local">
                        <tr><td colspan="2"><label for="iBudget"><?= $this->getHtml('Budget') ?></label>
                        <tr><td colspan="2"><input type="text" id="iBudget" name="budget" placeholder="">
                        <tr><td colspan="2"><label for="iBudget"><?= $this->getHtml('Limit') ?></label>
                        <tr><td colspan="2"><input type="text">
                        <tr><td colspan="2"><input type="submit" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>