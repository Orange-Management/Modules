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
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getText('Tickets'); ?></caption>
                <thead>
                <tr><td><?= $this->getText('ID', 0, 0); ?>
                    <td><?= $this->getText('Status'); ?>
                    <td><?= $this->getText('Priority'); ?>
                    <td class="full"><?= $this->getText('Title'); ?>
                    <td><?= $this->getText('Responsible'); ?>
                <tfoot>
                <tbody>
                <tr><td colspan="5" class="empty"><?= $this->getText('Empty', 0, 0); ?>
            </table>
        </div>
    </div>
</div>