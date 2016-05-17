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

$footerView->setPages(0 / 25);
$footerView->setPage(1);
$footerView->setResults(0);

echo $this->getData('nav')->render(); ?>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->lang['Arrival']['Arrivals']; ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->lang[0]['ID']; ?>
            <td><?= $this->l11n->lang['Arrival']['AccountID']; ?>
            <td class="wf-100"><?= $this->l11n->lang['Arrival']['Company']; ?>
            <td><?= $this->l11n->lang['Arrival']['Creator']; ?>
            <td><?= $this->l11n->lang['Arrival']['Created']; ?>
        <tfoot>
        <tr><td colspan="4"><?= $footerView->render(); ?>
        <tbody>
        <?php if(0 == 0) : ?>
        <tr class="empty"><td colspan="5"><?= $this->l11n->lang[0]['Empty']; ?>
                <?php endif; ?>
                <?php foreach ([] as $key => $template) :
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/reporter/report/view?id=' . $template->getId()); ?>
        <tr>
            <td>
                <?php endforeach; ?>
    </table>
</div>
