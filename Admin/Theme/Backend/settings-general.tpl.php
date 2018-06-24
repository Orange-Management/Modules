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
$_oname         = $this->getData('oname') ?? '';
$_timezone      = $this->getData('timezone') ?? '';
$_timeformat    = $this->getData('timeformat') ?? '';
$_language      = $this->getData('language') ?? '';
$_currency      = $this->getData('currency') ?? '';
$_decimal_point = $this->getData('decimal_point') ?? '';
$_thousands_sep = $this->getData('thousands_sep') ?? '';
$_password      = $this->getData('password') ?? '';
$_country       = $this->getData('country') ?? '';

$countries       = \phpOMS\Localization\ISO3166NameEnum::getConstants();
$timezones       = \phpOMS\Localization\TimeZoneEnumArray::getConstants();
$timeformats     = \phpOMS\Localization\ISO8601EnumArray::getConstants();
$languages       = \phpOMS\Localization\ISO639Enum::getConstants();
$currencies      = \phpOMS\Localization\ISO4217Enum::getConstants();
$l11nDefinitions = \phpOMS\System\File\Local\Directory::list(__DIR__ . '/../../../../phpOMS/Localization/Defaults/Definitions');
?>

<div class="tabular-2">
    <div class="box wf-100">
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
                            <form id="iGeneralSettings" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/settings/general'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                        <tr><td><label for="iOname"><?= $this->getHtml('OrganizationName'); ?></label>
                                        <tr><td><input id="iOname" name="oname" type="text" value="<?= $this->printHtml($_oname); ?>" placeholder="&#xf12e; Money Bin" required>
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
                            <form id="iSecuritySettings" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/settings/general'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                        <tr><td>
                                            <label for="iPassword"><?= $this->getHtml('PasswordRegex'); ?></label>
                                            <i class="fa fa-info-circle tooltip"><i><?= $this->getHtml('i:PasswordRegex') ?></i></i>
                                        <tr><td><input id="iPassword" name="passpattern" type="text" value="<?= $this->printHtml($_password); ?>" placeholder="&#xf023; ^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&;:\(\)\[\]=\{\}\+\-])[A-Za-z\d$@$!%*?&;:\(\)\[\]=\{\}\+\-]{8,}">
                                        <tr><td>
                                            <label for="iLoginRetries"><?= $this->getHtml('LoginRetries'); ?></label>
                                            <i class="fa fa-info-circle tooltip"><i><?= $this->getHtml('i:LoginRetries') ?></i></i>
                                        <tr><td><input id="iLoginRetries" name="loginretries" type="number" value="3" min="-1">
                                        <tr><td>
                                            <label for="iTimeoutPeriod"><?= $this->getHtml('TimeoutPeriod'); ?></label>
                                            <i class="fa fa-info-circle tooltip"><i><?= $this->getHtml('i:TimeoutPeriod') ?></i></i>
                                        <tr><td><input id="iTimeoutPeriod" name="timeoutperiod" type="number" value="3">
                                        <tr><td>
                                            <label for="iPasswordChangeInterval"><?= $this->getHtml('PasswordChangeInterval'); ?></label>
                                            <i class="fa fa-info-circle tooltip"><i><?= $this->getHtml('i:PasswordChangeInterval') ?></i></i>
                                        <tr><td><input id="iPasswordChangeInterval" name="passwordchangeinterval" type="number" value="90">
                                        <tr><td>
                                            <label for="iPasswordHistory"><?= $this->getHtml('PasswordHistory'); ?></label>
                                            <i class="fa fa-info-circle tooltip"><i><?= $this->getHtml('i:PasswordHistory') ?></i></i>
                                        <tr><td><input id="iPasswordHistory" name="passwordhistory" type="number" value="3">
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
                            <form id="iLoggingSettings" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/settings/general'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                        <tr><td>
                                            <span class="checkbox">
                                                <input id="iLog" name="log" type="checkbox" value="1">
                                                <label for="iLog"><?= $this->getHtml('Log'); ?></label>
                                            </span>
                                        <tr><td><label for="iLogPath"><?= $this->getHtml('LogPath'); ?></label>
                                        <tr><td><input id="iLogPath" name="logpath" type="text" value="<?= $this->printHtml($_password); ?>" placeholder="&#xf023; asdf">
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
                            <form id="fLocalization" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/settings/localization'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iDefaultLocalizations"><?= $this->getHtml('Defaults'); ?></label>
                                    <tr><td>
                                        <div class="ipt-wrap">
                                            <div class="ipt-first"><select id="iDefaultLocalizations" name="defaultlocalizations">
                                                    <option selected><?= $this->getHtml('Customized'); ?>
                                                    <?php foreach ($l11nDefinitions as $def) : ?>
                                                        <option value="<?= $this->printHtml(explode('.', $def)[0]); ?>"><?= $this->printHtml(explode('.', $def)[0]); ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="ipt-second"><input type="submit" value="<?= $this->getHtml('Load') ?>"></div>
                                        </div>
                                    <tr><td colspan="2"><label for="iCountries"><?= $this->getHtml('Country'); ?></label>
                                    <tr><td colspan="2">
                                            <select id="iCountries" name="country">
                                                <?php foreach ($countries as $code => $country) : ?>
                                                <option value="<?= $this->printHtml($code); ?>"<?= $this->printHtml(strtolower($code) == strtolower($_country) ? ' selected' : ''); ?>><?= $this->printHtml($country); ?>
                                                    <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iTimezones"><?= $this->getHtml('Timezone'); ?></label>
                                    <tr><td colspan="2">
                                            <select id="iTimezones" name="timezone">
                                                <?php foreach ($timezones as $code => $timezone) : ?>
                                                <option value="<?= $this->printHtml($code); ?>"<?= $this->printHtml($timezone == $_timezone ? ' selected' : ''); ?>><?= $this->printHtml($timezone); ?>
                                                    <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iTimeformats"><?= $this->getHtml('Timeformat'); ?></label>
                                    <tr><td colspan="2">
                                            <select id="iTimeformats" name="timeformat">
                                                <?php foreach ($timeformats as $code => $timeformat) : ?>
                                                <option value="<?= $this->printHtml($code); ?>"<?= $this->printHtml(strtolower($timeformat) == strtolower($_timeformat) ? ' selected' : ''); ?>><?= $this->printHtml($timeformat); ?>
                                                    <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iLanguages"><?= $this->getHtml('Language'); ?></label>
                                    <tr><td colspan="2">
                                            <select id="iLanguages" name="language">
                                                <?php foreach ($languages as $code => $language) : ?>
                                                <option value="<?= $this->printHtml($code); ?>"<?= $this->printHtml(strtolower($code) == strtolower($_language) ? ' selected' : ''); ?>><?= $this->printHtml($language); ?>
                                                    <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iTemperature"><?= $this->getHtml('Temperature'); ?></label>
                                    <tr><td colspan="2">
                                            <select id="iTemperature" name="temperature">
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
                            <form>
                                <table class="layout wf-100">
                                        <tr><td colspan="2"><label for="iCurrencies"><?= $this->getHtml('Currency'); ?></label>
                                    <tr><td colspan="2">
                                            <select form="fLocalization" id="iCurrencies" name="currency">
                                                <?php foreach ($currencies as $code => $currency) : ?>
                                                <option value="<?= $this->printHtml($code); ?>"<?= $this->printHtml(strtolower($code) == strtolower($_currency) ? ' selected' : ''); ?>><?= $this->printHtml($currency); ?>
                                                    <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><h2><?= $this->getHtml('Numberformat'); ?></h2>
                                    <tr><td><label for="iDecimalPoint"><?= $this->getHtml('DecimalPoint'); ?></label>
                                        <td><label for="iThousandSep"><?= $this->getHtml('ThousandsSeparator'); ?></label>
                                    <tr><td><input form="fLocalization" id="iDecimalPoint" name="decimalpoint" type="text" value="<?= $this->printHtml($_decimal_point); ?>" placeholder="." required>
                                        <td><input form="fLocalization" id="iThousandSep" name="thousandsep" type="text" value="<?= $this->printHtml($_thousands_sep); ?>" placeholder="," required>
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
                                    <tr><td><select form="fLocalization" id="iVeryLight" name="very_light">
                                        </select>
                                    <tr><td><label for="iLight"><?= $this->getHtml('Light'); ?></label>
                                    <tr><td><select form="fLocalization" id="iLight" name="light">
                                        </select>
                                    <tr><td><label for="iMedium"><?= $this->getHtml('Medium'); ?></label>
                                    <tr><td><select form="fLocalization" id="iMedium" name="medium">
                                        </select>
                                    <tr><td><label for="iHeavy"><?= $this->getHtml('Heavy'); ?></label>
                                    <tr><td><select form="fLocalization" id="iHeavy" name="heavy">
                                        </select>
                                    <tr><td><label for="iVeryHeavy"><?= $this->getHtml('VeryHeavy'); ?></label>
                                    <tr><td><select form="fLocalization" id="iVeryHeavy" name="very_heavy">
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
                                    <tr><td><select form="fLocalization" id="iVerySlow" name="very_slow">
                                        </select>
                                    <tr><td><label for="iSlow"><?= $this->getHtml('Slow'); ?></label>
                                    <tr><td><select form="fLocalization" id="iSlow" name="slow">
                                        </select>
                                    <tr><td><label for="iMedium"><?= $this->getHtml('Medium'); ?></label>
                                    <tr><td><select form="fLocalization" id="iMedium" name="medium">
                                        </select>
                                    <tr><td><label for="iFast"><?= $this->getHtml('Fast'); ?></label>
                                    <tr><td><select form="fLocalization" id="iFast" name="fast">
                                        </select>
                                    <tr><td><label for="iVeryFast"><?= $this->getHtml('VeryFast'); ?></label>
                                    <tr><td><select form="fLocalization" id="iVeryFast" name="very_fast">
                                        </select>
                                    <tr><td><label for="iSeaSpeed"><?= $this->getHtml('Sea'); ?></label>
                                    <tr><td><select form="fLocalization" id="iSeaSpeed" name="sea_speed">
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
                                    <tr><td><select form="fLocalization" id="iVeryShort" name="very_short">
                                        </select>
                                    <tr><td><label for="iShort"><?= $this->getHtml('Short'); ?></label>
                                    <tr><td><select form="fLocalization" id="iShort" name="short">
                                        </select>
                                    <tr><td><label for="iMedium"><?= $this->getHtml('Medium'); ?></label>
                                    <tr><td><select form="fLocalization" id="iMedium" name="medium">
                                        </select>
                                    <tr><td><label for="iLong"><?= $this->getHtml('Long'); ?></label>
                                    <tr><td><select form="fLocalization" id="iLong" name="long">
                                        </select>
                                    <tr><td><label for="iVeryLong"><?= $this->getHtml('VeryLong'); ?></label>
                                    <tr><td><select form="fLocalization" id="iVeryLong" name="very_long">
                                        </select>
                                    <tr><td><label for="iSeaLength"><?= $this->getHtml('Sea'); ?></label>
                                    <tr><td><select form="fLocalization" id="iSeaLength" name="sea_length">
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
                                    <tr><td><select form="fLocalization" id="iVerySmall" name="very_small">
                                        </select>
                                    <tr><td><label for="iSmall"><?= $this->getHtml('Small'); ?></label>
                                    <tr><td><select form="fLocalization" id="iSmall" name="small">
                                        </select>
                                    <tr><td><label for="iMedium"><?= $this->getHtml('Medium'); ?></label>
                                    <tr><td><select form="fLocalization" id="iMedium" name="medium">
                                        </select>
                                    <tr><td><label for="iLarge"><?= $this->getHtml('Large'); ?></label>
                                    <tr><td><select form="fLocalization" id="iLarge" name="large">
                                        </select>
                                    <tr><td><label for="iVeryLarge"><?= $this->getHtml('VeryLarge'); ?></label>
                                    <tr><td><select form="fLocalization" id="iVeryLarge" name="very_large">
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
                                    <tr><td><select form="fLocalization" id="iVerySmall" name="very_small">
                                        </select>
                                    <tr><td><label for="iSmall"><?= $this->getHtml('Small'); ?></label>
                                    <tr><td><select form="fLocalization" id="iSmall" name="small">
                                        </select>
                                    <tr><td><label for="iMedium"><?= $this->getHtml('Medium'); ?></label>
                                    <tr><td><select form="fLocalization" id="iMedium" name="medium">
                                        </select>
                                    <tr><td><label for="iLarge"><?= $this->getHtml('Large'); ?></label>
                                    <tr><td><select form="fLocalization" id="iLarge" name="large">
                                        </select>
                                    <tr><td><label for="iVeryLarge"><?= $this->getHtml('VeryLarge'); ?></label>
                                    <tr><td><select form="fLocalization" id="iVeryLarge" name="very_large">
                                        </select>
                                    <tr><td><label for="iTeaspoon"><?= $this->getHtml('Teaspoon'); ?></label>
                                    <tr><td><select form="fLocalization" id="iTeaspoon" name="teaspoon">
                                        </select>
                                    <tr><td><label for="iTablespoon"><?= $this->getHtml('Tablespoon'); ?></label>
                                    <tr><td><select form="fLocalization" id="iTablespoon" name="tablespoon">
                                        </select>
                                    <tr><td><label for="iGlass"><?= $this->getHtml('Glass'); ?></label>
                                    <tr><td><select form="fLocalization" id="iGlass" name="glass">
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
