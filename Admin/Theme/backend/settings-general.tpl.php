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

$countries     = \phpOMS\Localization\ISO3166EnumArray::getConstants();
$timezones     = \phpOMS\Localization\TimeZoneEnumArray::getConstants();
$timeformats   = \phpOMS\Localization\ISO8601EnumArray::getConstants();
$languages     = \phpOMS\Localization\ISO639EnumArray::getConstants();
$currencies    = \phpOMS\Localization\ISO4217EnumArray::getConstants();

?>
<section class="box w-50 floatLeft">
    <header><h1><?= $this->l11n->getText('Admin', 'Backend', 'Settings') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/settings/general'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                    <tr><td><label for="iOname"><?= $this->l11n->getText('Admin', 'Backend', 'OrganizationName') ?></label>
                    <tr><td><input id="iOname" name="oname" type="text" value="<?= $_oname; ?>" placeholder="&#xf12e; Money Bin" required>
                    <tr><td><label for="iPassword"><?= $this->l11n->getText('Admin', 'Backend', 'PasswordRegex') ?></label>
                    <tr><td><input id="iPassword" name="passpattern" type="text" value="<?= $_password; ?>" placeholder="&#xf023; ^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&;:\(\)\[\]=\{\}\+\-])[A-Za-z\d$@$!%*?&;:\(\)\[\]=\{\}\+\-]{8,}">
                    <tr><td><input type="submit" value="<?= $this->l11n->getText(0, 'Backend', 'Save') ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-50 floatLeft">
    <header><h1><?= $this->l11n->getText('Admin', 'Backend', 'Localization') ?></h1></header>
    <div class="inner">
        <form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/settings/localization'); ?>" method="post">
            <table class="layout wf-100">
                <tbody>
                <tr><td colspan="2"><label for="iCountries"><?= $this->l11n->getText('Admin', 'Backend', 'Country') ?></label>
                <tr><td colspan="2"><select id="iCountries" name="country">
                            <?php foreach($countries as $code => $country) : ?>
                            <option value="<?= $code; ?>"<?= strtolower($code) == strtolower($_country) ? ' selected' : ''; ?>><?= $country; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td colspan="2"><label for="iTimezones"><?= $this->l11n->getText('Admin', 'Backend', 'Timezone') ?></label>
                <tr><td colspan="2"><select id="iTimezones" name="timezone">
                            <?php foreach($timezones as $code => $timezone) : ?>
                            <option value="<?= $code; ?>"<?= $timezone == $_timezone ? ' selected' : ''; ?>><?= $timezone; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td colspan="2"><label for="iTimeformats"><?= $this->l11n->getText('Admin', 'Backend', 'Timeformat') ?></label>
                <tr><td colspan="2"><select id="iTimeformats" name="timeformat">
                            <?php foreach($timeformats as $code => $timeformat) : ?>
                            <option value="<?= $code; ?>"<?= strtolower($timeformat) == strtolower($_timeformat) ? ' selected' : ''; ?>><?= $timeformat; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td colspan="2"><label for="iLanguages"><?= $this->l11n->getText('Admin', 'Backend', 'Language') ?></label>
                <tr><td colspan="2"><select id="iLanguages" name="language">
                            <?php foreach($languages as $code => $language) : ?>
                            <option value="<?= $code; ?>"<?= strtolower($code) == strtolower($_language) ? ' selected' : ''; ?>><?= $language; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td colspan="2"><label for="iCurrencies"><?= $this->l11n->getText('Admin', 'Backend', 'Currency') ?></label>
                <tr><td colspan="2"><select id="iCurrencies" name="currency">
                            <?php foreach($currencies as $code => $currency) : ?>
                            <option value="<?= $code; ?>"<?= strtolower($code) == strtolower($_currency) ? ' selected' : ''; ?>><?= $currency[0]; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td colspan="2"><h2><?= $this->l11n->getText('Admin', 'Backend', 'Numberformat') ?></h2>
                <tr><td><label for="iDecimalPoint"><?= $this->l11n->getText('Admin', 'Backend', 'DecimalPoint') ?></label>
                    <td><label for="iThousandSep"><?= $this->l11n->getText('Admin', 'Backend', 'ThousandsSeparator') ?></label>
                <tr><td><input id="iDecimalPoint" name="decimalpoint" type="text" value="<?= $_decimal_point; ?>" placeholder="." required>
                    <td><input id="iThousandSep" name="thousandsep" type="text" value="<?= $_thousands_sep; ?>" placeholder="," required>
                <tr><td colspan="2"><input type="submit" value="<?= $this->l11n->getText(0, 'Backend', 'Save') ?>">
            </table>
        </form>
    </div>
</section>
