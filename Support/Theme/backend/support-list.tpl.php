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

<section class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->lang['Support']['Tickets']; ?></caption>
        <thead>
        <tr><td><?= $this->l11n->lang[0]['ID']; ?>
            <td><?= $this->l11n->lang['Support']['Status']; ?>
            <td><?= $this->l11n->lang['Support']['Priority']; ?>
            <td class="full"><?= $this->l11n->lang['Support']['Title']; ?>
            <td><?= $this->l11n->lang['Support']['Responsible']; ?>
        <tfoot>
        <tbody>
        <tr><td colspan="5" class="empty"><?= $this->l11n->lang[0]['Empty']; ?>
    </table>
</section>
