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

$footerView->setPages(0 / 25);
$footerView->setPage(1);
$footerView->setResults(0);

$logs = array_reverse($this->app->logger->get(25), true);

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="box col-xs-12 wf-100">
        <table class="table red">
            <caption><?= $this->getText('Logs'); ?></caption>
            <thead>
            <tr>
                <td><?= $this->getText('Timestamp'); ?>
                <td><?= $this->getText('Level'); ?>
                <td><?= $this->getText('Source'); ?>
                <td class="wf-100"><?= $this->getText('Message'); ?>
                    <tfoot>
            <tr>
                <td colspan="5"><?= $footerView->render(); ?>
                    <tbody>
                    <?php foreach ($logs as $key => $value) :
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/admin/monitoring/logs/single?{?}&id=' . $key);?>
            <tr>
                <td><a href=<?= $url; ?>><i class="fa fa-clock-o"></i> <?= $value[0] ?? ''; ?></a>
                <td><a href=<?= $url; ?>><i class="fa fa-<?= in_array($value[1], ['notice', 'info', 'debug']) ? 'info-circle' : 'warning'; ?>"></i> <?= $value[1] ?? ''; ?></a>
                <td><a href=<?= $url; ?>><i class="fa fa-wifi"></i> <?= $value[2] ?? ''; ?></a>
                <td><a href=<?= $url; ?>><i class="fa fa-commenting"></i> <?= $value[7] ?? ''; ?></a>
                    <?php endforeach;
                    if (!isset($key)) : ?>
            <tr>
                <td colspan="4">
                    <?php endif; ?>
        </table>
    </div>
</div>
