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
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000301001);

$sidenav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$sidenav->setTemplate('/Modules/Navigation/Theme/Backend/mid-side');
$sidenav->setNav($this->getData('nav'));
$sidenav->setLanguage($this->l11n->language);
$sidenav->setParent(1000301001);
?>
<?= $nav->render(); ?>
<div itemscope itemtype="http://schema.org/Person">
    <div class="b-7" id="i3-2-1">
        <div class="b-5" id="i3-2-4">
            <div class="bc-1">
                <img src="/Modules/Profile/Theme/Backend/img/profile-default-small.jpg" itemprop="image">
            </div>
        </div>
        <?= $sidenav->render(); ?>
    </div>
    <div class="b-6" id="i3-2-2">
        <div class="b b-2 c3-2 c3" id="i3-2-3">
            <h1>
                <?= $this->l11n->lang['Profile']['Profile']; ?>
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
            </h1>

            <div class="bc-1">
                <!-- @formatter:off -->
                <table class="tc-1">
                    <tr>
                        <th><?= $this->l11n->lang['Profile']['Name']; ?>
                        <td><span itemprop="familyName">Duck</span>, <span itemprop="givenName">Donald</span>
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
                        <td itemprop="email"><a href="mailto:>donald.duck@email.com<">donald.duck[at]email.com</a>
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
                        <td>09.06.1934
                    <tr>
                        <th><?= $this->l11n->lang['Profile']['LastLogin']; ?>
                        <td>01.04.2015
                    <tr>
                        <th><?= $this->l11n->lang['Profile']['Status']; ?>
                        <td><span class="green">Active</span>
                </table>
                <!-- @formatter:on -->
            </div>
        </div>
    </div>
</div>
