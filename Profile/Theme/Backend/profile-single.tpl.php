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
<div class="row">
    <div class="col-xs-12 col-md-6">
        <section itemscope itemtype="http://schema.org/Person" class="box wf-100">
            <header><h1><?= $this->getHtml('Profile') ?></h1></header>
            <div class="inner">
                <!-- @formatter:off -->
                        <table class="list">
                            <tr>
                                <th><?= $this->getHtml('Name') ?>
                                <td><span itemprop="familyName"><?= htmlspecialchars($account->getName3(), ENT_COMPAT, 'utf-8'); ?></span>, <span itemprop="givenName"><?= htmlspecialchars($account->getName1(), ENT_COMPAT, 'utf-8'); ?></span>
                            <tr>
                                <th><?= $this->getHtml('Occupation') ?>
                                <td itemprop="jobTitle">Sailor
                            <tr>
                                <th><?= $this->getHtml('Birthday') ?>
                                <td itemprop="birthDate">06.09.1934
                            <tr>
                                <th><?= $this->getHtml('Ranks') ?>
                                <td itemprop="memberOf">Gosling
                            <tr>
                                <th><?= $this->getHtml('Email') ?>
                                <td itemprop="email"><a href="mailto:>donald.duck@email.com<"><?= htmlspecialchars($account->getEmail(), ENT_COMPAT, 'utf-8'); ?></a>
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
                                <th><?= $this->getHtml('Phone') ?>
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
                                <th><?= $this->getHtml('Registered') ?>
                                <td><?= htmlspecialchars($account->getCreatedAt()->format('Y-m-d'), ENT_COMPAT, 'utf-8'); ?>
                            <tr>
                                <th><?= $this->getHtml('LastLogin') ?>
                                <td><?= htmlspecialchars($account->getLastActive()->format('Y-m-d'), ENT_COMPAT, 'utf-8'); ?>
                            <tr>
                                <th><?= $this->getHtml('Status') ?>
                                <td><span class="tag green"><?= htmlspecialchars($account->getStatus(), ENT_COMPAT, 'utf-8'); ?></span>
                        </table>
                        <!-- @formatter:on -->
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getHtml('Media', 'Media') ?></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', 0, 0); ?>
                    <td class="wf-100"><?= $this->getHtml('Name', 'Media') ?>
                    <td><?= $this->getHtml('Type', 'Media') ?>
                    <td><?= $this->getHtml('Created', 'Media') ?>
                <tfoot>
                <tr><td colspan="4"><?= htmlspecialchars($footerView->render(), ENT_COMPAT, 'utf-8'); ?>
                <tbody>
                <?php $c = 0; foreach ([] as $key => $value) : $c++;
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/admin/group/settings?{?}&id=' . $value->getId()); ?>
                    <tr>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getId(), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getNewestHistory()->getPosition(), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getNewestHistory()->getPosition(), ENT_COMPAT, 'utf-8'); ?></a>
                        <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getNewestStatus()->getStatus(), ENT_COMPAT, 'utf-8'); ?></a>
                <?php endforeach; ?>
                <?php if($c === 0) : ?>
                    <tr><td colspan="4" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
