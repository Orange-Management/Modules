<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
use Modules\Media\Models\NullMedia;
use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View $this
 */
$account = $this->getData('account');

$settings = $this->getData('settings') ?? [];

$countries       = \phpOMS\Localization\ISO3166NameEnum::getConstants();
$timezones       = \phpOMS\Localization\TimeZoneEnumArray::getConstants();
$timeformats     = \phpOMS\Localization\ISO8601EnumArray::getConstants();
$languages       = \phpOMS\Localization\ISO639Enum::getConstants();
$currencies      = \phpOMS\Localization\ISO4217Enum::getConstants();
$l11nDefinitions = \phpOMS\System\File\Local\Directory::list(__DIR__ . '/../../../../phpOMS/Localization/Defaults/Definitions');

$weights      = \phpOMS\Utils\Converter\WeightType::getConstants();
$speeds       = \phpOMS\Utils\Converter\SpeedType::getConstants();
$areas        = \phpOMS\Utils\Converter\AreaType::getConstants();
$lengths      = \phpOMS\Utils\Converter\LengthType::getConstants();
$volumes      = \phpOMS\Utils\Converter\VolumeType::getConstants();
$temperatures = \phpOMS\Utils\Converter\TemperatureType::getConstants();

echo $this->getData('nav')->render();
?>
<div class="tabview tab-2">
    <div class="box wf-100 col-xs-12">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('General'); ?></label></li>
            <li><label for="c-tab-2"><?= $this->getHtml('Localization'); ?></label></li>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <section itemscope itemtype="http://schema.org/Person" itemtype="http://schema.org/Organization" class="box wf-100">
                        <header>
                            <h1>
                                <?php if (!empty($account->getAccount()->getName3()) || !empty($account->getAccount()->getName2())) : ?>
                                    <span itemprop="familyName" itemprop="legalName">
                                        <?= $this->printHtml(empty($account->getAccount()->getName3()) ? $account->getAccount()->getName2() : $account->getAccount()->getName3()); ?></span>,
                                <?php endif; ?>
                                <span itemprop="givenName" itemprop="legalName">
                                    <?= $this->printHtml($account->getAccount()->getName1()); ?>
                                </span>
                            </h1>
                        </header>
                        <div class="inner">
                            <!-- @formatter:off -->
                                <span class="rf">
                                    <img class="m-profile rf"
                                        alt="<?= $this->getHtml('ProfileImage'); ?>"
                                        itemprop="logo"
                                        data-lazyload="<?= $account->getImage() instanceof NullMedia ? UriFactory::build('Web/Backend/img/user_default_' . \mt_rand(1, 6) .'.png') : UriFactory::build('{/prefix}' . $account->getImage()->getPath()); ?>"
                                    >
                                </span>
                                    <table class="list" style="table-layout: fixed">
                                        <tr>
                                            <th><?= $this->getHtml('Occupation') ?>
                                            <td itemprop="jobTitle">Sailor
                                        <tr>
                                            <th><?= $this->getHtml('Birthday') ?>
                                            <td itemprop="birthDate" itemprop="foundingDate">06.09.1934
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

                <div class="col-xs-12 col-md-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Visibility') ?></h1></header>
                        <div class="inner">
                            <p>Define which users and user groups can see your profile</p>
                            <?= $this->getData('accGrpSelector')->render('iVisibility', 'visibility', true); ?>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-4">
                    <?= $this->getData('medialist')->render([]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <?= $this->getData('calendar')->render(null /* calendar object here */); ?>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Localization'); ?></h1></header>
                        <div class="inner">
                            <form id="fLocalization" name="fLocalization" action="<?= UriFactory::build('{/api}admin/settings/localization'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iDefaultLocalizations"><?= $this->getHtml('Defaults'); ?></label>
                                    <tr><td>
                                        <div class="ipt-wrap">
                                            <div class="ipt-first"><select id="iDefaultLocalizations" name="defaultlocalizations">
                                                    <option selected disabled><?= $this->getHtml('Customized'); ?>
                                                    <?php foreach ($l11nDefinitions as $def) : ?>
                                                        <option value="<?= $this->printHtml(\explode('.', $def)[0]); ?>"><?= $this->printHtml(\explode('.', $def)[0]); ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="ipt-second"><input type="submit" name="loadDefaultLocalization" value="<?= $this->getHtml('Load') ?>"></div>
                                        </div>
                                    <tr><td colspan="2"><label for="iCountries"><?= $this->getHtml('Country'); ?></label>
                                    <tr><td colspan="2">
                                            <select id="iCountries" name="settings_1000000019">
                                                <?php foreach ($countries as $code => $country) : ?>
                                                <option value="<?= $this->printHtml($code); ?>"<?= $this->printHtml(\strtolower($code) === \strtolower($settings[1000000019]) ? ' selected' : ''); ?>><?= $this->printHtml($country); ?>
                                                <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iTimezones"><?= $this->getHtml('Timezone'); ?></label>
                                    <tr><td colspan="2">
                                            <select id="iTimezones" name="settings_1000000021">
                                                <?php foreach ($timezones as $code => $timezone) : ?>
                                                <option value="<?= $this->printHtml($code); ?>"<?= $this->printHtml($timezone === $settings[1000000021] ? ' selected' : ''); ?>><?= $this->printHtml($timezone); ?>
                                                <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iLanguages"><?= $this->getHtml('Language'); ?></label>
                                    <tr><td colspan="2">
                                            <select id="iLanguages" name="settings_1000000020">
                                                <?php foreach ($languages as $code => $language) : ?>
                                                <option value="<?= $this->printHtml($code); ?>"<?= $this->printHtml(\strtolower($code) === \strtolower($settings[1000000020]) ? ' selected' : ''); ?>><?= $this->printHtml($language); ?>
                                                <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iTemperature"><?= $this->getHtml('Temperature'); ?></label>
                                    <tr><td colspan="2">
                                            <select id="iTemperature" name="settings_1000000022">
                                                <?php foreach ($temperatures as $code => $temperature) : ?>
                                                <option value="<?= $this->printHtml($code); ?>"<?= $this->printHtml($temperature === $settings[1000000022] ? ' selected' : ''); ?>><?= $this->printHtml($temperature); ?>
                                                <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><input id="iSubmitLocalization" name="submitLocalization" type="submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-4">
                    <section class="box wf-100 green">
                        <header><h1><?= $this->getHtml('Numeric'); ?></h1></header>
                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                        <tr><td colspan="2"><label for="iCurrencies"><?= $this->getHtml('Currency'); ?></label>
                                    <tr><td colspan="2">
                                            <select form="fLocalization" id="iCurrencies" name="settings_1000000023">
                                                <?php foreach ($currencies as $code => $currency) : ?>
                                                <option value="<?= $this->printHtml($code); ?>"<?= $this->printHtml(\strtolower($code) === \strtolower($settings[1000000023]) ? ' selected' : ''); ?>><?= $this->printHtml($currency); ?>
                                                    <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><h2><?= $this->getHtml('Numberformat'); ?></h2>
                                    <tr><td><label for="iDecimalPoint"><?= $this->getHtml('DecimalPoint'); ?></label>
                                        <td><label for="iThousandSep"><?= $this->getHtml('ThousandsSeparator'); ?></label>
                                    <tr><td><input form="fLocalization" id="iDecimalPoint" name="settings_1000000027" type="text" value="<?= $this->printHtml($settings[1000000027]); ?>" placeholder="." required>
                                        <td><input form="fLocalization" id="iThousandSep" name="settings_1000000028" type="text" value="<?= $this->printHtml($settings[1000000028]); ?>" placeholder="," required>
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-4">
                    <section class="box wf-100 red">
                        <header><h1><?= $this->getHtml('Weight'); ?></h1></header>
                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iVeryLight"><?= $this->getHtml('VeryLight'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iVeryLight" name="settings_1000001001">
                                            <?php foreach ($weights as $code => $weight) : ?>
                                            <option value="<?= $this->printHtml($weight); ?>"<?= $this->printHtml($weight === $settings[1000002001] ? ' selected' : ''); ?>><?= $this->printHtml($weight); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iLight"><?= $this->getHtml('Light'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iLight" name="settings_1000001002">
                                            <?php foreach ($weights as $code => $weight) : ?>
                                            <option value="<?= $this->printHtml($weight); ?>"<?= $this->printHtml($weight === $settings[1000002002] ? ' selected' : ''); ?>><?= $this->printHtml($weight); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iMedium"><?= $this->getHtml('Medium'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iMedium" name="settings_1000001003">
                                            <?php foreach ($weights as $code => $weight) : ?>
                                            <option value="<?= $this->printHtml($weight); ?>"<?= $this->printHtml($weight === $settings[1000002003] ? ' selected' : ''); ?>><?= $this->printHtml($weight); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iHeavy"><?= $this->getHtml('Heavy'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iHeavy" name="settings_1000001004">
                                            <?php foreach ($weights as $code => $weight) : ?>
                                            <option value="<?= $this->printHtml($weight); ?>"<?= $this->printHtml($weight === $settings[1000002004] ? ' selected' : ''); ?>><?= $this->printHtml($weight); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iVeryHeavy"><?= $this->getHtml('VeryHeavy'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iVeryHeavy" name="settings_1000001005">
                                            <?php foreach ($weights as $code => $weight) : ?>
                                            <option value="<?= $this->printHtml($weight); ?>"<?= $this->printHtml($weight === $settings[1000002005] ? ' selected' : ''); ?>><?= $this->printHtml($weight); ?>
                                            <?php endforeach; ?>
                                        </select>
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <section class="box wf-100 blue">
                        <header><h1><?= $this->getHtml('Speed'); ?></h1></header>
                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iVerySlow"><?= $this->getHtml('VerySlow'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iVerySlow" name="settings_1000002001">
                                            <?php foreach ($speeds as $code => $speed) : ?>
                                            <option value="<?= $this->printHtml($speed); ?>"<?= $this->printHtml($speed === $settings[1000002001] ? ' selected' : ''); ?>><?= $this->printHtml($speed); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iSlow"><?= $this->getHtml('Slow'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iSlow" name="settings_1000002002">
                                            <?php foreach ($speeds as $code => $speed) : ?>
                                            <option value="<?= $this->printHtml($speed); ?>"<?= $this->printHtml($speed === $settings[1000002002] ? ' selected' : ''); ?>><?= $this->printHtml($speed); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iMedium"><?= $this->getHtml('Medium'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iMedium" name="settings_1000002003">
                                            <?php foreach ($speeds as $code => $speed) : ?>
                                            <option value="<?= $this->printHtml($speed); ?>"<?= $this->printHtml($speed === $settings[1000002003] ? ' selected' : ''); ?>><?= $this->printHtml($speed); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iFast"><?= $this->getHtml('Fast'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iFast" name="settings_1000002004">
                                            <?php foreach ($speeds as $code => $speed) : ?>
                                            <option value="<?= $this->printHtml($speed); ?>"<?= $this->printHtml($speed === $settings[1000002004] ? ' selected' : ''); ?>><?= $this->printHtml($speed); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iVeryFast"><?= $this->getHtml('VeryFast'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iVeryFast" name="settings_1000002005">
                                            <?php foreach ($speeds as $code => $speed) : ?>
                                            <option value="<?= $this->printHtml($speed); ?>"<?= $this->printHtml($speed === $settings[1000002005] ? ' selected' : ''); ?>><?= $this->printHtml($speed); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iSeaSpeed"><?= $this->getHtml('Sea'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iSeaSpeed" name="settings_1000002006">
                                            <?php foreach ($speeds as $code => $speed) : ?>
                                            <option value="<?= $this->printHtml($speed); ?>"<?= $this->printHtml($speed === $settings[1000002006] ? ' selected' : ''); ?>><?= $this->printHtml($speed); ?>
                                            <?php endforeach; ?>
                                        </select>
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-4">
                    <section class="box wf-100 purple">
                        <header><h1><?= $this->getHtml('Length'); ?></h1></header>
                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iVeryShort"><?= $this->getHtml('VeryShort'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iVeryShort" name="settings_1000003001">
                                            <?php foreach ($lengths as $code => $length) : ?>
                                            <option value="<?= $this->printHtml($length); ?>"<?= $this->printHtml($length === $settings[1000003001] ? ' selected' : ''); ?>><?= $this->printHtml($length); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iShort"><?= $this->getHtml('Short'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iShort" name="settings_1000003002">
                                            <?php foreach ($lengths as $code => $length) : ?>
                                            <option value="<?= $this->printHtml($length); ?>"<?= $this->printHtml($length === $settings[1000003002] ? ' selected' : ''); ?>><?= $this->printHtml($length); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iMedium"><?= $this->getHtml('Medium'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iMedium" name="settings_1000003003">
                                            <?php foreach ($lengths as $code => $length) : ?>
                                            <option value="<?= $this->printHtml($length); ?>"<?= $this->printHtml($length === $settings[1000003003] ? ' selected' : ''); ?>><?= $this->printHtml($length); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iLong"><?= $this->getHtml('Long'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iLong" name="settings_1000003004">
                                            <?php foreach ($lengths as $code => $length) : ?>
                                            <option value="<?= $this->printHtml($length); ?>"<?= $this->printHtml($length === $settings[1000003004] ? ' selected' : ''); ?>><?= $this->printHtml($length); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iVeryLong"><?= $this->getHtml('VeryLong'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iVeryLong" name="settings_1000003005">
                                            <?php foreach ($lengths as $code => $length) : ?>
                                            <option value="<?= $this->printHtml($length); ?>"<?= $this->printHtml($length === $settings[1000003005] ? ' selected' : ''); ?>><?= $this->printHtml($length); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iSeaLength"><?= $this->getHtml('Sea'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iSeaLength" name="settings_1000003006">
                                            <?php foreach ($lengths as $code => $length) : ?>
                                            <option value="<?= $this->printHtml($length); ?>"<?= $this->printHtml($length === $settings[1000003006] ? ' selected' : ''); ?>><?= $this->printHtml($length); ?>
                                            <?php endforeach; ?>
                                        </select>
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Area'); ?></h1></header>
                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iVerySmall"><?= $this->getHtml('VerySmall'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iVerySmall" name="settings_1000004001">
                                            <?php foreach ($areas as $code => $area) : ?>
                                            <option value="<?= $this->printHtml($area); ?>"<?= $this->printHtml($area === $settings[1000004001] ? ' selected' : ''); ?>><?= $this->printHtml($area); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iSmall"><?= $this->getHtml('Small'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iSmall" name="settings_1000004002">
                                            <?php foreach ($areas as $code => $area) : ?>
                                            <option value="<?= $this->printHtml($area); ?>"<?= $this->printHtml($area === $settings[1000004002] ? ' selected' : ''); ?>><?= $this->printHtml($area); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iMedium"><?= $this->getHtml('Medium'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iMedium" name="settings_1000004003">
                                            <?php foreach ($areas as $code => $area) : ?>
                                            <option value="<?= $this->printHtml($area); ?>"<?= $this->printHtml($area === $settings[1000004003] ? ' selected' : ''); ?>><?= $this->printHtml($area); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iLarge"><?= $this->getHtml('Large'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iLarge" name="settings_1000004004">
                                            <?php foreach ($areas as $code => $area) : ?>
                                            <option value="<?= $this->printHtml($area); ?>"<?= $this->printHtml($area === $settings[1000004004] ? ' selected' : ''); ?>><?= $this->printHtml($area); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iVeryLarge"><?= $this->getHtml('VeryLarge'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iVeryLarge" name="settings_1000004005">
                                            <?php foreach ($areas as $code => $area) : ?>
                                            <option value="<?= $this->printHtml($area); ?>"<?= $this->printHtml($area === $settings[1000004005] ? ' selected' : ''); ?>><?= $this->printHtml($area); ?>
                                            <?php endforeach; ?>
                                        </select>
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Volume'); ?></h1></header>
                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iVerySmall"><?= $this->getHtml('VerySmall'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iVerySmall" name="settings_1000005001">
                                            <?php foreach ($volumes as $code => $volume) : ?>
                                            <option value="<?= $this->printHtml($volume); ?>"<?= $this->printHtml($volume === $settings[1000005001] ? ' selected' : ''); ?>><?= $this->printHtml($volume); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iSmall"><?= $this->getHtml('Small'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iSmall" name="settings_1000005002">
                                            <?php foreach ($volumes as $code => $volume) : ?>
                                            <option value="<?= $this->printHtml($volume); ?>"<?= $this->printHtml($volume === $settings[1000005002] ? ' selected' : ''); ?>><?= $this->printHtml($volume); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iMedium"><?= $this->getHtml('Medium'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iMedium" name="settings_1000005003">
                                            <?php foreach ($volumes as $code => $volume) : ?>
                                            <option value="<?= $this->printHtml($volume); ?>"<?= $this->printHtml($volume === $settings[1000005003] ? ' selected' : ''); ?>><?= $this->printHtml($volume); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iLarge"><?= $this->getHtml('Large'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iLarge" name="settings_1000005004">
                                            <?php foreach ($volumes as $code => $volume) : ?>
                                            <option value="<?= $this->printHtml($volume); ?>"<?= $this->printHtml($volume === $settings[1000005004] ? ' selected' : ''); ?>><?= $this->printHtml($volume); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iVeryLarge"><?= $this->getHtml('VeryLarge'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iVeryLarge" name="settings_1000005005">
                                            <?php foreach ($volumes as $code => $volume) : ?>
                                            <option value="<?= $this->printHtml($volume); ?>"<?= $this->printHtml($volume === $settings[1000005005] ? ' selected' : ''); ?>><?= $this->printHtml($volume); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iTeaspoon"><?= $this->getHtml('Teaspoon'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iTeaspoon" name="settings_1000005006">
                                            <?php foreach ($volumes as $code => $volume) : ?>
                                            <option value="<?= $this->printHtml($volume); ?>"<?= $this->printHtml($volume === $settings[1000005006] ? ' selected' : ''); ?>><?= $this->printHtml($volume); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iTablespoon"><?= $this->getHtml('Tablespoon'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iTablespoon" name="settings_1000005007">
                                            <?php foreach ($volumes as $code => $volume) : ?>
                                            <option value="<?= $this->printHtml($volume); ?>"<?= $this->printHtml($volume === $settings[1000005007] ? ' selected' : ''); ?>><?= $this->printHtml($volume); ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <tr><td><label for="iGlass"><?= $this->getHtml('Glass'); ?></label>
                                    <tr><td>
                                        <select form="fLocalization" id="iGlass" name="settings_1000005008">
                                            <?php foreach ($volumes as $code => $volume) : ?>
                                            <option value="<?= $this->printHtml($volume); ?>"<?= $this->printHtml($volume === $settings[1000005008] ? ' selected' : ''); ?>><?= $this->printHtml($volume); ?>
                                            <?php endforeach; ?>
                                        </select>
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
