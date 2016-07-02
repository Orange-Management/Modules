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

$media      = \Modules\Media\Models\MediaMapper::getNewest(25);
$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(count($media) / 25);
$footerView->setPage(1);

echo $this->getData('nav')->render(); ?>
<div class="box">
    <table class="table">
        <caption><?= $this->l11n->getText('Media', 'Media'); ?></caption>
        <thead>
        <tr>
            <td class="wf-100"><?= $this->l11n->getText('Media', 'Name'); ?>
            <td><?= $this->l11n->getText('Media', 'Type'); ?>
            <td><?= $this->l11n->getText('Media', 'Size'); ?>
            <td><?= $this->l11n->getText('Media', 'Creator'); ?>
            <td><?= $this->l11n->getText('Media', 'Created'); ?>
                <tfoot>
        <tr>
            <td colspan="3"><?= $footerView->render(); ?>
                <tbody>
                <?php $count = 0; foreach($media as $key => $value) : $count++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/media/single?id=' . $value->getId()); ?>
                <tr>
                    <td><a href="<?= $url; ?>"><?= $value->getName(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->getExtension(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->getSize(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->getCreatedBy(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->getCreatedAt()->format('Y-m-d H:i:s'); ?></a>
                <?php endforeach; ?>
                <?php if($count === 0) : ?>
        <tr><td colspan="5" class="empty"><?= $this->l11n->getText(0, 'Empty'); ?>
                <?php endif; ?>
    </table>
</div>
