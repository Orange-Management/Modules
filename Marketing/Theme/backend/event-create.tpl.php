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

<section class="box w-50">
    <header><h1><?= $this->l11n->getText('Marketing', 'Backend', 'Event') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/reporter/template'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td colspan="2"><label for="iTitle"><?= $this->l11n->getText('Marketing', 'Backend', 'Type') ?></label>
                <tr><td colspan="2"><select></select>
                <tr><td colspan="2"><label for="iBudget"><?= $this->l11n->getText('Marketing', 'Backend', 'Title'); ?></label>
                <tr><td colspan="2"><input type="text">
                <tr><td colspan="2"><label for="iBudget"><?= $this->l11n->getText('Marketing', 'Backend', 'Description'); ?></label>
                <tr><td colspan="2"><textarea></textarea>
                <tr><td><label for="iTitle"><?= $this->l11n->getText('Marketing', 'Backend', 'Start') ?></label><td><label for="iTitle"><?= $this->l11n->getText('Marketing', 'Backend', 'End') ?></label>
                <tr><td><input type="datetime-local"><td><input type="datetime-local">
                <tr><td colspan="2"><label for="iBudget"><?= $this->l11n->getText('Marketing', 'Backend', 'Budget'); ?></label>
                <tr><td colspan="2"><input type="text" id="iBudget" name="budget" placeholder="">
            </table>
        </form>
    </div>
</section>
