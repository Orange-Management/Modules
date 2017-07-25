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

$footerView  = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

$accounts = $this->getData('accounts');
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getHtml('Profiles') ?></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', 0, 0); ?>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
                    <td><?= $this->getHtml('Activity') ?>
                <tfoot>
                <tr>
                    <td colspan="3"><?= $footerView->render(); ?>
                <tbody>
                <?php $count = 0; foreach($accounts as $key => $account) : $count++;
                $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/profile/single?{?}&id=' . $account->getId()); ?>
                    <tr data-href="<?= $url; ?>">
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($account->getId(), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($account->getName3() . ' ' . $account->getName2() . ' ' . $account->getName1(), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($account->getLastActive()->format('Y-m-d'), ENT_COMPAT, 'utf-8'); ?></a>
                <?php endforeach; ?>
                <?php if($count === 0) : ?>
                <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
