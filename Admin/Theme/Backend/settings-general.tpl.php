<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Admin\Template\Backend
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

/**
 * @var \phpOMS\Views\View $this
 */
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
                <div class="col-xs-12 col-md-6">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Settings'); ?></h1></header>
                        <div class="inner">
                            <form id="iGeneralSettings" action="<?= \phpOMS\Uri\UriFactory::build('{/lang}/api/admin/settings/general'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                        <tr><td><label for="iOname"><?= $this->getHtml('OrganizationName'); ?></label>
                                        <tr><td><input id="iOname" name="settings_1000000009" type="text" value="<?= $this->printHtml($settings[1000000009]); ?>" placeholder="&#xf12e; Money Bin" required>
                                        <tr><td><input id="iSubmitGeneral" name="submitGeneral" type="submit" value="<?= $this->getHtml('Save', 0); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-6">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Security'); ?></h1></header>
                        <div class="inner">
                            <form id="iSecuritySettings" action="<?= \phpOMS\Uri\UriFactory::build('{/lang}/api/admin/settings/general'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                        <tr><td>
                                            <label for="iPassword"><?= $this->getHtml('PasswordRegex'); ?></label>
                                            <i class="fa fa-info-circle tooltip"><i data-tooltip="<?= $this->getHtml('i:PasswordRegex') ?>"></i></i>
                                        <tr><td><input id="iPassword" name="settings_1000000001" type="text" value="<?= $this->printHtml($settings[1000000001]); ?>" placeholder="&#xf023; ^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&;:\(\)\[\]=\{\}\+\-])[A-Za-z\d$@$!%*?&;:\(\)\[\]=\{\}\+\-]{8,}">
                                        <tr><td>
                                            <label for="iLoginRetries"><?= $this->getHtml('LoginRetries'); ?></label>
                                            <i class="fa fa-info-circle tooltip"><i data-tooltip="<?= $this->getHtml('i:LoginRetries') ?>"></i></i>
                                        <tr><td><input id="iLoginRetries" name="settings_1000000005" type="number" value="<?= $this->printHtml($settings[1000000005]); ?>" min="-1">
                                        <tr><td>
                                            <label for="iTimeoutPeriod"><?= $this->getHtml('TimeoutPeriod'); ?></label>
                                            <i class="fa fa-info-circle tooltip"><i data-tooltip="<?= $this->getHtml('i:TimeoutPeriod') ?>"></i></i>
                                        <tr><td><input id="iTimeoutPeriod" name="settings_1000000002" type="number" value="<?= $this->printHtml($settings[1000000002]); ?>">
                                        <tr><td>
                                            <label for="iPasswordChangeInterval"><?= $this->getHtml('PasswordChangeInterval'); ?></label>
                                            <i class="fa fa-info-circle tooltip"><i data-tooltip="<?= $this->getHtml('i:PasswordChangeInterval') ?>"></i></i>
                                        <tr><td><input id="iPasswordChangeInterval" name="settings_1000000003" type="number" value="<?= $this->printHtml($settings[1000000003]); ?>">
                                        <tr><td>
                                            <label for="iPasswordHistory"><?= $this->getHtml('PasswordHistory'); ?></label>
                                            <i class="fa fa-info-circle tooltip"><i data-tooltip="<?= $this->getHtml('i:PasswordHistory') ?>"></i></i>
                                        <tr><td><input id="iPasswordHistory" name="settings_1000000004" type="number" value="<?= $this->printHtml($settings[1000000004]); ?>">
                                        <tr><td><input id="iSubmitGeneral" name="submitGeneral" type="submit" value="<?= $this->getHtml('Save', 0); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-6">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Logging'); ?></h1></header>
                        <div class="inner">
                            <form id="iLoggingSettings" action="<?= \phpOMS\Uri\UriFactory::build('{/lang}/api/admin/settings/general'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                        <tr><td>
                                            <span class="checkbox">
                                                <input id="iLog" name="settings_1000000006" type="checkbox" value="<?= $this->printHtml($settings[1000000006]); ?>">
                                                <label for="iLog"><?= $this->getHtml('Log'); ?></label>
                                            </span>
                                        <tr><td><label for="iLogPath"><?= $this->getHtml('LogPath'); ?></label>
                                        <tr><td><input id="iLogPath" name="settings_1000000007" type="text" value="<?= $this->printHtml($settings[1000000007]); ?>" placeholder="&#xf023; asdf">
                                        <tr><td><input id="iSubmitGeneral" name="submitGeneral" type="submit" value="<?= $this->getHtml('Save', 0); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
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
                            <form id="fLocalization" name="fLocalization" action="<?= \phpOMS\Uri\UriFactory::build('{/lang}/api/admin/settings/localization'); ?>" method="post">
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
                                    <tr><td colspan="2"><input id="iSubmitLocalization" name="submitLocalization" type="submit" value="<?= $this->getHtml('Save', 0); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-4">
                    <section class="box wf-100 green">
                        <header><h1><?= $this->getHtml('Numeric'); ?></h1></header>
                        <div class="inner">
                            <form id="fNumerics" name="fNumerics">
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
                            <form id="fWeight" name="fWeight">
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
                            <form id="fSpeed" name="fSpeed">
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
                            <form id="fLength" name="fLength">
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
                            <form  id="fArea" name="fArea">
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
                            <form  id="fVolume" name="fVolume">
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
