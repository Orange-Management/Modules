<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
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

$footerView->setPages($this->getData('list:count') ?? 0 / 25);
$footerView->setPage(1);
$footerView->setResults($this->getData('list:count') ?? 1);

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <table class="box table red">
            <caption><?= $this->getHtml('Groups') ?></caption>
            <thead>
                <tr>
                    <td><?= $this->getHtml('ID', 0, 0); ?>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
                    <td><?= $this->getHtml('Parents') ?>
                    <td><?= $this->getHtml('Children') ?>
                    <td><?= $this->getHtml('Members') ?>
            <tfoot>
                <tr><td colspan="5"><?= $footerView->render(); ?>
            <tbody>
                <?php $c = 0; foreach ($this->getData('list:elements') as $key => $value) : $c++;
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/admin/group/settings?{?}&id=' . $value->getId()); ?>
                <tr data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getId(), ENT_COMPAT, 'utf-8'); ?></a>
                    <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getName(), ENT_COMPAT, 'utf-8'); ?></a>
                    <td>
                    <td>
                    <td>
                <?php endforeach; ?>
                <?php if($c === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
        </table>
    </div>
</div>