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

$newsList     = $this->getData('newsList');
$headlineList = $this->getData('headlineList');

echo $this->getData('nav')->render(); ?>

<section class="box w-50 floatLeft">
    <table class="table">
        <caption><?= $this->l11n->lang['News']['News'] ?></caption>
        <thead>
        <tr>
            <td class="wf-100"><?= $this->l11n->lang['News']['Title']; ?>
            <td><?= $this->l11n->lang['News']['Author']; ?>
            <td><?= $this->l11n->lang['News']['Date']; ?>
                <tbody>
                <?php $count = 0; foreach([] as $key => $value) : $count++; ?>
                <?php endforeach; ?>
                <?php if($count === 0) : ?>
        <tr><td colspan="3" class="empty"><?= $this->l11n->lang[0]['Empty']; ?>
                <?php endif; ?>
    </table>
</section>

<section class="box w-50 floatLeft">
    <table class="table">
        <caption><?= $this->l11n->lang['News']['Headlines'] ?></caption>
        <thead>
        <tr>
            <td class="wf-100"><?= $this->l11n->lang['News']['Title']; ?>
            <td><?= $this->l11n->lang['News']['Author']; ?>
            <td><?= $this->l11n->lang['News']['Date']; ?>
                <tbody>
                <?php $count = 0; foreach([] as $key => $value) : $count++; ?>
                <?php endforeach; ?>
                <?php if($count === 0) : ?>
        <tr><td colspan="3" class="empty"><?= $this->l11n->lang[0]['Empty']; ?>
                <?php endif; ?>
    </table>
</section>
