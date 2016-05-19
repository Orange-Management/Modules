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

$footerView  = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

$accounts = $this->getData('accounts');
?>

<div class="box">
    <table class="table">
        <caption><?= $this->l11n->lang['Profile']['Profiles']; ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->lang[0]['ID']; ?>
            <td class="wf-100"><?= $this->l11n->lang['Profile']['Name']; ?>
            <td><?= $this->l11n->lang['Profile']['Activity']; ?>
        <tfoot>
        <tr>
            <td colspan="3"><?= $footerView->render(); ?>
        <tbody>
        <?php $count = 0; foreach($accounts as $key => $account) : $count++;
        $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/profile/single?id=' . $account->getId()); ?>
            <tr>
                <td><a href="<?= $url; ?>"><?= $account->getId(); ?></a>
                <td><a href="<?= $url; ?>"><?= $account->getName3() . ' ' . $account->getName2() . ' ' . $account->getName1(); ?></a>
                <td><a href="<?= $url; ?>"><?= $account->getLastActive()->format('Y-m-d'); ?></a>
        <?php endforeach; ?>
        <?php if($count === 0) : ?>
        <tr><td colspan="3" class="empty"><?= $this->l11n->lang[0]['Empty']; ?>
        <?php endif; ?>
    </table>
</div>
