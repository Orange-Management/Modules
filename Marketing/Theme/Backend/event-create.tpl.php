<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getText('Event') ?></h1></header>
            <div class="inner">
                <form action="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/api/reporter/template'); ?>" method="post">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iTitle"><?= $this->getText('Type') ?></label>
                        <tr><td colspan="2"><select></select>
                        <tr><td colspan="2"><label for="iBudget"><?= $this->getText('Title'); ?></label>
                        <tr><td colspan="2"><input type="text">
                        <tr><td colspan="2"><label for="iBudget"><?= $this->getText('Description'); ?></label>
                        <tr><td colspan="2"><textarea></textarea>
                        <tr><td><label for="iTitle"><?= $this->getText('Start') ?></label><td><label for="iTitle"><?= $this->getText('End') ?></label>
                        <tr><td><input type="datetime-local"><td><input type="datetime-local">
                        <tr><td colspan="2"><label for="iBudget"><?= $this->getText('Budget'); ?></label>
                        <tr><td colspan="2"><input type="text" id="iBudget" name="budget" placeholder="">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>