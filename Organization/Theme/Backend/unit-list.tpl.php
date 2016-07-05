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

$footerView->setPages(1 / 25);
$footerView->setPage(1);
$footerView->setResults(1);

echo $this->getData('nav')->render(); ?>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->getText('Organization', 'Backend', 'Units'); ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->getText(0, 'Backend', 'ID'); ?>
            <td class="wf-100"><?= $this->l11n->getText('Organization', 'Backend', 'Name'); ?>
            <td><?= $this->l11n->getText('Organization', 'Backend', 'Parent'); ?>
                <tfoot>
        <tr><td colspan="3"><?= $footerView->render(); ?>
                <tbody>
                <?php foreach ($this->getData('list:elements') as $key => $value) :
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/organization/unit/profile?id=' . $value->getId()); ?>
        <tr>
            <td data-label="<?= $this->l11n->getText(0, 'Backend', 'ID'); ?>"><a href="<?= $url; ?>"><?= $value->getId(); ?></a>
            <td data-label="<?= $this->l11n->getText('Organization', 'Backend', 'Name'); ?>"><a href="<?= $url; ?>"><?= $value->getName(); ?></a>
            <td data-label="<?= $this->l11n->getText('Organization', 'Backend', 'Parent'); ?>"><a href="<?= $url; ?>"><?= $value->getParent(); ?></a>
                <?php endforeach; ?>
    </table>
</div>
