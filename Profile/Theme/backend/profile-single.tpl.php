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
echo $this->getData('nav')->render();
?>
<section itemscope itemtype="http://schema.org/Person" class="box w-33">
    <h1><?= $this->l11n->lang['Profile']['Profile']; ?></h1>
    <div class="inner">
        <!-- @formatter:off -->
                <table class="list">
                    <tr>
                        <th><?= $this->l11n->lang['Profile']['Name']; ?>
                        <td><span itemprop="familyName"><?= $account->getName3(); ?></span>, <span itemprop="givenName"><?= $account->getName1(); ?></span>
                    <tr>
                        <th><?= $this->l11n->lang['Profile']['Occupation']; ?>
                        <td itemprop="jobTitle">Sailor
                    <tr>
                        <th><?= $this->l11n->lang['Profile']['Birthday']; ?>
                        <td itemprop="birthDate">06.09.1934
                    <tr>
                        <th><?= $this->l11n->lang['Profile']['Ranks']; ?>
                        <td itemprop="memberOf">Gosling
                    <tr>
                        <th><?= $this->l11n->lang['Profile']['Email']; ?>
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
                        <th><?= $this->l11n->lang['Profile']['Phone']; ?>
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
                        <th><?= $this->l11n->lang['Profile']['Registered']; ?>
                        <td><?= $account->getCreatedAt()->format('Y-m-d'); ?>
                    <tr>
                        <th><?= $this->l11n->lang['Profile']['LastLogin']; ?>
                        <td><?= $account->getLastActive()->format('Y-m-d'); ?>
                    <tr>
                        <th><?= $this->l11n->lang['Profile']['Status']; ?>
                        <td><span class="tag green"><?= $account->getStatus(); ?></span>
                </table>
                <!-- @formatter:on -->
    </div>
</section>
