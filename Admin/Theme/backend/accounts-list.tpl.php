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

$footerView->setPages($this->getData('list:count') / 25);
$footerView->setPage(1);
$footerView->setResults($this->getData('list:count'));

echo $this->getData('nav')->render();
?>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->lang['Admin']['Groups']; ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->lang[0]['ID']; ?>
            <td><?= $this->l11n->lang['Admin']['Status']; ?>
            <td class="wf-100"><?= $this->l11n->lang['Admin']['Name']; ?>
            <td><?= $this->l11n->lang['Admin']['Activity']; ?>
            <td><?= $this->l11n->lang['Admin']['Created']; ?>
                <tfoot>
        <tr><td colspan="5"><?= $footerView->render(); ?>
                <tbody>
                <?php $c = 0; foreach ($this->getData('list:elements') as $key => $value) : $c++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/admin/account/settings?id=' . $value->getId()); ?>
        <tr>
            <td><a href="<?= $url; ?>"><?= $value->getStatus(); ?></a>
            <td><a href="<?= $url; ?>"><?= $value->getId(); ?></a>
            <td><a href="<?= $url; ?>"><?= $value->getName1(); ?></a>
            <td><a href="<?= $url; ?>"><?= $value->getLastActive()->format('Y-m-d H:i:s'); ?></a>
            <td><a href="<?= $url; ?>"><?= $value->getCreatedAt()->format('Y-m-d H:i:s'); ?></a>
                <?php endforeach; ?>
                <?php if($c === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->l11n->lang[0]['Empty']; ?>
                        <?php endif; ?>
    </table>
</div>
