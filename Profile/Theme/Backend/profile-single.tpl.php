<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
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
                                <th><?= $this->getHtml('Name') ?><img class="m-profile" alt="<?= $this->getHtml('ProfileImage'); ?>" src="<?= $account->getImage() instanceof \Modules\Media\Models\NullMedia ? \phpOMS\Uri\UriFactory::build('{/base}/Web/Backend/img/user_default_' . mt_rand(1, 6) .'.png') : \phpOMS\Uri\UriFactory::build('{/base}/' . $account->getImage()->getPath()); ?>">
                                <td><span itemprop="familyName"><?= $this->printHtml($account->getAccount()->getName3()); ?></span>, <span itemprop="givenName"><?= $this->printHtml($account->getAccount()->getName1()); ?></span>
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
                                <td itemprop="email"><a href="mailto:>donald.duck@email.com<"><?= $this->printHtml($account->getAccount()->getEmail()); ?></a>
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
                                <td><?= $this->printHtml($account->getAccount()->getCreatedAt()->format('Y-m-d')); ?>
                            <tr>
                                <th><?= $this->getHtml('LastLogin') ?>
                                <td><?= $this->printHtml($account->getAccount()->getLastActive()->format('Y-m-d')); ?>
                            <tr>
                                <th><?= $this->getHtml('Status') ?>
                                <td><span class="tag green"><?= $this->printHtml($account->getAccount()->getStatus()); ?></span>
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
                <tr><td colspan="4"><?= $footerView->render(); ?>
                <tbody>
                <?php $c = 0; foreach ([] as $key => $value) : $c++;
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/admin/group/settings?{?}&id=' . $value->getId()); ?>
                    <tr>
                        <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
                        <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getNewestHistory()->getPosition()); ?></a>
                        <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getNewestHistory()->getPosition()); ?></a>
                        <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getNewestStatus()->getStatus()); ?></a>
                <?php endforeach; ?>
                <?php if($c === 0) : ?>
                    <tr><td colspan="4" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
