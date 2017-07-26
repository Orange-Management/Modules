<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
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
                <caption><?= $this->getHtml('Tickets') ?></caption>
                <thead>
                <tr><td><?= $this->getHtml('ID', 0, 0); ?>
                    <td><?= $this->getHtml('Status') ?>
                    <td><?= $this->getHtml('Priority') ?>
                    <td class="full"><?= $this->getHtml('Title') ?>
                    <td><?= $this->getHtml('Responsible') ?>
                <tfoot>
                <tbody>
                <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
            </table>
        </div>
    </div>
</div>