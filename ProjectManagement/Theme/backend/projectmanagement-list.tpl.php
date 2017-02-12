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

$footerView   = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

$list = $this->getData('projects');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table">
                <caption><?= $this->getText('Projects') ?></caption>
                <thead>
                <tr>
                    <td class="wf-100"><?= $this->getText('Title'); ?>
                    <td><?= $this->getText('Start'); ?>
                    <td><?= $this->getText('Due'); ?>
                <tfoot>
                <tr>
                    <td colspan="5"><?= $footerView->render(); ?>
                <tbody>
                <?php $count = 0; foreach($list as $key => $value) : $count++; 
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/projectmanagement/profile?{?}&id=' . $value->getId());?>
                    <td><a href="<?= $url; ?>"><?= $value->getName(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->getStart()->format('Y-m-d'); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->getEnd()->format('Y-m-d'); ?></a>
                <?php endforeach; ?>
                <?php if($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
