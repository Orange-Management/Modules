<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/*
 * UI Logic
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

$countries     = \phpOMS\Localization\ISO3166NameEnum::getConstants();
$timezones     = \phpOMS\Localization\TimeZoneEnumArray::getConstants();
$timeformats   = \phpOMS\Localization\ISO8601EnumArray::getConstants();
$languages     = \phpOMS\Localization\ISO639Enum::getConstants();
$currencies    = \phpOMS\Localization\ISO4217Enum::getConstants();
?>

<div class="tabular-2">
    <div class="box wf-100">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getText('General') ?></label></li>
            <li><label for="c-tab-2"><?= $this->getText('Localization') ?></label></li>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="box wf-100">
                        <header><h1><?= $this->getText('Settings') ?></h1></header>
                        <div class="inner">
                            <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/settings/general'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                        <tr><td><label for="iOname"><?= $this->getText('OrganizationName') ?></label>
                                        <tr><td><input id="iOname" name="oname" type="text" value="<?= $_oname; ?>" placeholder="&#xf12e; Money Bin" required>
                                        <tr><td><label for="iPassword"><?= $this->getText('PasswordRegex') ?></label>
                                        <tr><td><input id="iPassword" name="passpattern" type="text" value="<?= $_password; ?>" placeholder="&#xf023; ^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&;:\(\)\[\]=\{\}\+\-])[A-Za-z\d$@$!%*?&;:\(\)\[\]=\{\}\+\-]{8,}">
                                        <tr><td><input type="submit" value="<?= $this->getText('Save', 0) ?>">
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
                        <header><h1><?= $this->getText('Localization') ?></h1></header>
                        <div class="inner">
                            <form id="fLocalization" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/settings/localization'); ?>" method="post">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td colspan="2"><label for="iCountries"><?= $this->getText('Country') ?></label>
                                    <tr><td colspan="2"><select id="iCountries" name="country">
                                                <?php foreach($countries as $code => $country) : ?>
                                                <option value="<?= $code; ?>"<?= strtolower($code) == strtolower($_country) ? ' selected' : ''; ?>><?= $country; ?>
                                                    <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iTimezones"><?= $this->getText('Timezone') ?></label>
                                    <tr><td colspan="2"><select id="iTimezones" name="timezone">
                                                <?php foreach($timezones as $code => $timezone) : ?>
                                                <option value="<?= $code; ?>"<?= $timezone == $_timezone ? ' selected' : ''; ?>><?= $timezone; ?>
                                                    <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iTimeformats"><?= $this->getText('Timeformat') ?></label>
                                    <tr><td colspan="2"><select id="iTimeformats" name="timeformat">
                                                <?php foreach($timeformats as $code => $timeformat) : ?>
                                                <option value="<?= $code; ?>"<?= strtolower($timeformat) == strtolower($_timeformat) ? ' selected' : ''; ?>><?= $timeformat; ?>
                                                    <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iLanguages"><?= $this->getText('Language') ?></label>
                                    <tr><td colspan="2"><select id="iLanguages" name="language">
                                                <?php foreach($languages as $code => $language) : ?>
                                                <option value="<?= $code; ?>"<?= strtolower($code) == strtolower($_language) ? ' selected' : ''; ?>><?= $language; ?>
                                                    <?php endforeach; ?>
                                            </select>
                                    <tr><td colspan="2"><label for="iTemperature"><?= $this->getText('Temperature') ?></label>
                                    <tr><td colspan="2"><select id="iTemperature" name="temperature">
                                            </select>
                                    <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Save', 0) ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

            <div class="col-xs-12 col-md-4">
                <section class="box wf-100">
                    <header><h1><?= $this->getText('Numeric') ?></h1></header>
                    <div class="inner">
                        <form>
                            <table class="layout wf-100">
                                    <tr><td colspan="2"><label for="iCurrencies"><?= $this->getText('Currency') ?></label>
                                <tr><td colspan="2"><select form="fLocalization" id="iCurrencies" name="currency">
                                            <?php foreach($currencies as $code => $currency) : ?>
                                            <option value="<?= $code; ?>"<?= strtolower($code) == strtolower($_currency) ? ' selected' : ''; ?>><?= $currency; ?>
                                                <?php endforeach; ?>
                                        </select>
                                <tr><td colspan="2"><h2><?= $this->getText('Numberformat') ?></h2>
                                <tr><td><label for="iDecimalPoint"><?= $this->getText('DecimalPoint') ?></label>
                                    <td><label for="iThousandSep"><?= $this->getText('ThousandsSeparator') ?></label>
                                <tr><td><input form="fLocalization" id="iDecimalPoint" name="decimalpoint" type="text" value="<?= $_decimal_point; ?>" placeholder="." required>
                                    <td><input form="fLocalization" id="iThousandSep" name="thousandsep" type="text" value="<?= $_thousands_sep; ?>" placeholder="," required>
                            </table>
                        </form>
                    </div>
                </section>
            </div>

<div class="col-xs-12 col-md-4">
            <section class="box wf-100">
                <header><h1><?= $this->getText('Weight') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout wf-100">
                            <tbody>
                            <tr><label for="iVeryLight"><?= $this->getText('VeryLight') ?></label>
                            <tr><select form="fLocalization" id="iVeryLight" name="very_light">
                                    </select>
                            <tr><label for="iLight"><?= $this->getText('Light') ?></label>
                            <tr><select form="fLocalization" id="iLight" name="light">
                                    </select>
                            <tr><label for="iMedium"><?= $this->getText('Medium') ?></label>
                            <tr><select form="fLocalization" id="iMedium" name="medium">
                                    </select>
                            <tr><label for="iHeavy"><?= $this->getText('Heavy') ?></label>
                            <tr><select form="fLocalization" id="iHeavy" name="heavy">
                                    </select>
                            <tr><label for="iVeryHeavy"><?= $this->getText('VeryHeavy') ?></label>
                            <tr><select form="fLocalization" id="iVeryHeavy" name="very_heavy">
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
                <header><h1><?= $this->getText('Speed') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout wf-100">
                            <tbody>
                            <tr><label for="iVerySlow"><?= $this->getText('VerySlow') ?></label>
                            <tr><select form="fLocalization" id="iVerySlow" name="very_slow">
                                    </select>
                            <tr><label for="iSlow"><?= $this->getText('Slow') ?></label>
                            <tr><select form="fLocalization" id="iSlow" name="slow">
                                    </select>
                            <tr><label for="iMedium"><?= $this->getText('Medium') ?></label>
                            <tr><select form="fLocalization" id="iMedium" name="medium">
                                    </select>
                            <tr><label for="iFast"><?= $this->getText('Fast') ?></label>
                            <tr><select form="fLocalization" id="iFast" name="fast">
                                    </select>
                            <tr><label for="iVeryFast"><?= $this->getText('VeryFast') ?></label>
                            <tr><select form="fLocalization" id="iVeryFast" name="very_fast">
                                    </select>
                            <tr><label for="iSeaSpeed"><?= $this->getText('Sea') ?></label>
                            <tr><select form="fLocalization" id="iSeaSpeed" name="sea_speed">
                                    </select>
                        </table>
                    </form>
                </div>
            </section>
            </div>

<div class="col-xs-12 col-md-4">
            <section class="box wf-100">
                <header><h1><?= $this->getText('Length') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout wf-100">
                            <tbody>
                            <tr><label for="iVeryShort"><?= $this->getText('VeryShort') ?></label>
                            <tr><select form="fLocalization" id="iVeryShort" name="very_short">
                                    </select>
                            <tr><label for="iShort"><?= $this->getText('Short') ?></label>
                            <tr><select form="fLocalization" id="iShort" name="short">
                                    </select>
                            <tr><label for="iMedium"><?= $this->getText('Medium') ?></label>
                            <tr><select form="fLocalization" id="iMedium" name="medium">
                                    </select>
                            <tr><label for="iLong"><?= $this->getText('Long') ?></label>
                            <tr><select form="fLocalization" id="iLong" name="long">
                                    </select>
                            <tr><label for="iVeryLong"><?= $this->getText('VeryLong') ?></label>
                            <tr><select form="fLocalization" id="iVeryLong" name="very_long">
                                    </select>
                            <tr><label for="iSeaLength"><?= $this->getText('Sea') ?></label>
                            <tr><select form="fLocalization" id="iSeaLength" name="sea_length">
                                    </select>
                        </table>
                    </form>
                </div>
            </section>
            </div>

<div class="col-xs-12 col-md-4">
            <section class="box wf-100">
                <header><h1><?= $this->getText('Area') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout wf-100">
                            <tbody>
                            <tr><label for="iVerySmall"><?= $this->getText('VerySmall') ?></label>
                            <tr><select form="fLocalization" id="iVerySmall" name="very_small">
                                    </select>
                            <tr><label for="iSmall"><?= $this->getText('Small') ?></label>
                            <tr><select form="fLocalization" id="iSmall" name="small">
                                    </select>
                            <tr><label for="iMedium"><?= $this->getText('Medium') ?></label>
                            <tr><select form="fLocalization" id="iMedium" name="medium">
                                    </select>
                            <tr><label for="iLarge"><?= $this->getText('Large') ?></label>
                            <tr><select form="fLocalization" id="iLarge" name="large">
                                    </select>
                            <tr><label for="iVeryLarge"><?= $this->getText('VeryLarge') ?></label>
                            <tr><select form="fLocalization" id="iVeryLarge" name="very_large">
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
                <header><h1><?= $this->getText('Volume') ?></h1></header>
                <div class="inner">
                    <form>
                        <table class="layout wf-100">
                            <tbody>
                            <tr><label for="iVerySmall"><?= $this->getText('VerySmall') ?></label>
                            <tr><select form="fLocalization" id="iVerySmall" name="very_small">
                                    </select>
                            <tr><label for="iSmall"><?= $this->getText('Small') ?></label>
                            <tr><select form="fLocalization" id="iSmall" name="small">
                                    </select>
                            <tr><label for="iMedium"><?= $this->getText('Medium') ?></label>
                            <tr><select form="fLocalization" id="iMedium" name="medium">
                                    </select>
                            <tr><label for="iLarge"><?= $this->getText('Large') ?></label>
                            <tr><select form="fLocalization" id="iLarge" name="large">
                                    </select>
                            <tr><label for="iVeryLarge"><?= $this->getText('VeryLarge') ?></label>
                            <tr><select form="fLocalization" id="iVeryLarge" name="very_large">
                                    </select>
                            <tr><label for="iTeaspoon"><?= $this->getText('Teaspoon') ?></label>
                            <tr><select form="fLocalization" id="iTeaspoon" name="teaspoon">
                                    </select>
                            <tr><label for="iTablespoon"><?= $this->getText('Tablespoon') ?></label>
                            <tr><select form="fLocalization" id="iTablespoon" name="tablespoon">
                                    </select>
                            <tr><label for="iGlass"><?= $this->getText('Glass') ?></label>
                            <tr><select form="fLocalization" id="iGlass" name="glass">
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
