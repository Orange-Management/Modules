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

$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

$docs = $this->getData('docs');

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getHtml('Documents') ?></caption>
                <thead>
                <tr>
                    <td class="wf-100"><?= $this->getHtml('Title') ?>
                    <td><?= $this->getHtml('Creator') ?>
                    <td><?= $this->getHtml('Created') ?>
                <tfoot>
                <tr>
                    <td colspan="3"><?= $footerView->render(); ?>
                <tbody>
                <?php $count = 0; foreach($docs as $key => $value) : $count++;
                $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/editor/single?{?}&id=' . $value->getId()); ?>
                    <tr data-href="<?= $url; ?>">
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getTitle(), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getCreatedBy()->getName1(), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getCreatedAt()->format('Y-m-d H:i:s'), ENT_COMPAT, 'utf-8'); ?></a>
                <?php endforeach; ?>
                <?php if($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
