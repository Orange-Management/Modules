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

$footerView->setPages(0 / 25);
$footerView->setPage(1);
$footerView->setResults(0);

$logs = array_reverse($this->app->logger->get(25), true);

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="box col-xs-12 wf-100">
        <table class="table red">
            <caption><?= $this->getHtml('Logs') ?></caption>
            <thead>
            <tr>
                <td><?= $this->getHtml('Timestamp') ?>
                <td><?= $this->getHtml('Level') ?>
                <td><?= $this->getHtml('Source') ?>
                <td class="wf-100"><?= $this->getHtml('Message') ?>
                    <tfoot>
            <tr>
                <td colspan="5"><?= $footerView->render(); ?>
                    <tbody>
                    <?php foreach ($logs as $key => $value) :
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/admin/monitoring/logs/single?{?}&id=' . $key);?>
            <tr>
                <td><a href=<?= htmlspecialchars($url, ENT_COMPAT, 'utf-8'); ?>><i class="fa fa-clock-o"></i> <?= htmlspecialchars($value[0] ?? '', ENT_COMPAT, 'utf-8'); ?></a>
                <td><a href=<?= htmlspecialchars($url, ENT_COMPAT, 'utf-8'); ?>><i class="fa fa-<?= htmlspecialchars(in_array($value[1], ['notice', 'info', 'debug']) ? 'info-circle' : 'warning', ENT_COMPAT, 'utf-8'); ?>"></i> <?= htmlspecialchars($value[1] ?? '', ENT_COMPAT, 'utf-8'); ?></a>
                <td><a href=<?= htmlspecialchars($url, ENT_COMPAT, 'utf-8'); ?>><i class="fa fa-wifi"></i> <?= htmlspecialchars($value[2] ?? '', ENT_COMPAT, 'utf-8'); ?></a>
                <td><a href=<?= htmlspecialchars($url, ENT_COMPAT, 'utf-8'); ?>><i class="fa fa-commenting"></i> <?= htmlspecialchars($value[7] ?? '', ENT_COMPAT, 'utf-8'); ?></a>
                    <?php endforeach;
                    if (!isset($key)) : ?>
            <tr>
                <td colspan="4">
                    <?php endif; ?>
        </table>
    </div>
</div>
