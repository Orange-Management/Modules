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
 * @var \Modules\Tasks\Models\Task[] $tasks
 */
$account = $this->getData('account');

$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(1 / 25);
$footerView->setPage(1);
$footerView->setResults(1);

echo $this->getData('nav')->render();
?>
<section itemscope itemtype="http://schema.org/Person" class="box w-33">
    <header><h1><?= $this->l11n->getText('Profile', 'Backend', 'Profile'); ?></h1></header>
    <div class="inner">
        <!-- @formatter:off -->
                <table class="list">
                    <tr>
                        <th><?= $this->l11n->getText('Profile', 'Backend', 'Name'); ?>
                        <td><span itemprop="familyName"><?= $account->getName3(); ?></span>, <span itemprop="givenName"><?= $account->getName1(); ?></span>
                    <tr>
                        <th><?= $this->l11n->getText('Profile', 'Backend', 'Occupation'); ?>
                        <td itemprop="jobTitle">Sailor
                    <tr>
                        <th><?= $this->l11n->getText('Profile', 'Backend', 'Birthday'); ?>
                        <td itemprop="birthDate">06.09.1934
                    <tr>
                        <th><?= $this->l11n->getText('Profile', 'Backend', 'Ranks'); ?>
                        <td itemprop="memberOf">Gosling
                    <tr>
                        <th><?= $this->l11n->getText('Profile', 'Backend', 'Email'); ?>
                        <td itemprop="email"><a href="mailto:>donald.duck@email.com<"><?= $account->getEmail(); ?></a>
                    <tr>
                        <th>Address
                        <td>
                    <tr>
                        <th class="vT">Private
                        <td itemprop="address">SMALLSYS INC<br>795 E DRAGRAM<br>TUCSON AZ 85705<br>USA
                    <tr>
                        <th class="vT">Work
                        <td itemprop="address">SMALLSYS INC<br>795 E DRAGRAM<br>TUCSON AZ 85705<br>USA
                    <tr>
                        <th><?= $this->l11n->getText('Profile', 'Backend', 'Phone'); ?>
                        <td>
                    <tr>
                        <th>Private
                        <td itemprop="telephone">+01 12345-4567
                    <tr>
                        <th>Mobile
                        <td itemprop="telephone">+01 12345-4567
                    <tr>
                        <th>Work
                        <td itemprop="telephone">+01 12345-4567
                    <tr>
                        <th><?= $this->l11n->getText('Profile', 'Backend', 'Registered'); ?>
                        <td><?= $account->getCreatedAt()->format('Y-m-d'); ?>
                    <tr>
                        <th><?= $this->l11n->getText('Profile', 'Backend', 'LastLogin'); ?>
                        <td><?= $account->getLastActive()->format('Y-m-d'); ?>
                    <tr>
                        <th><?= $this->l11n->getText('Profile', 'Backend', 'Status'); ?>
                        <td><span class="tag green"><?= $account->getStatus(); ?></span>
                </table>
                <!-- @formatter:on -->
    </div>
</section>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->getText('Profile', 'Backend', 'Media'); ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->getText(0, 'Backend', 'ID'); ?>
            <td class="wf-100"><?= $this->l11n->getText('Profile', 'Backend', 'Title'); ?>
            <td><?= $this->l11n->getText('Profile', 'Backend', 'Type'); ?>
            <td><?= $this->l11n->getText('Profile', 'Backend', 'Created'); ?>
        <tfoot>
        <tr><td colspan="4"><?= $footerView->render(); ?>
        <tbody>
        <?php $c = 0; foreach ([] as $key => $value) : $c++;
            $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/admin/group/settings?id=' . $value->getId()); ?>
            <tr>
                <td><a href="<?= $url; ?>"><?= $value->getId(); ?></a>
                <td><a href="<?= $url; ?>"><?= $value->getNewestHistory()->getPosition(); ?></a>
                <td><a href="<?= $url; ?>"><?= $value->getNewestHistory()->getPosition(); ?></a>
                <td><a href="<?= $url; ?>"><?= $value->getNewestStatus()->getStatus(); ?></a>
        <?php endforeach; ?>
        <?php if($c === 0) : ?>
            <tr><td colspan="4" class="empty"><?= $this->l11n->getText(0, 'Backend', 'Empty'); ?>
        <?php endif; ?>
    </table>
</div>
