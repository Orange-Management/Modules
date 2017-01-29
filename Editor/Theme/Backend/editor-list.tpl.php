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

$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

$docs = $this->getData('docs');

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table">
                <caption><?= $this->getText('Documents'); ?></caption>
                <thead>
                <tr>
                    <td class="wf-100"><?= $this->getText('Title'); ?>
                    <td><?= $this->getText('Creator'); ?>
                    <td><?= $this->getText('Created'); ?>
                <tfoot>
                <tr>
                    <td colspan="3"><?= $footerView->render(); ?>
                <tbody>
                <?php $count = 0; foreach($docs as $key => $value) : $count++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/editor/single?id=' . $value->getId()); ?>
                    <tr>
                        <td><a href="<?= $url; ?>"><?= $value->getTitle(); ?></a>
                        <td><a href="<?= $url; ?>"><?= $value->getCreatedBy(); ?></a>
                        <td><a href="<?= $url; ?>"><?= $value->getCreatedAt()->format('Y-m-d H:i:s'); ?></a>
                <?php endforeach; ?>
                <?php if($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
