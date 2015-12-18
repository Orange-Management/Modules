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

$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

echo $this->getData('nav')->render(); ?>
<section class="box">
    <table class="table">
        <caption><?= $this->l11n->lang['Media']['Media']; ?></caption>
        <thead>
        <tr>
            <td class="wf-100"><?= $this->l11n->lang['Media']['Name']; ?>
            <td><?= $this->l11n->lang['Media']['Type']; ?>
            <td><?= $this->l11n->lang['Media']['Size']; ?>
            <td><?= $this->l11n->lang['Media']['Creator']; ?>
            <td><?= $this->l11n->lang['Media']['Created']; ?>
                <tfoot>
        <tr>
            <td colspan="3"><?= $footerView->render(); ?>
                <tbody>
                <?php $count = 0; foreach([] as $key => $value) : $count++; ?>
                <?php endforeach; ?>
                <?php if($count === 0) : ?>
        <tr><td colspan="5" class="empty"><?= $this->l11n->lang[0]['Empty']; ?>
                <?php endif; ?>
    </table>
</section>
