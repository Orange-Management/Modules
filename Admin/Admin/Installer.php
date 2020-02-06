<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Admin\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\Admin;

use phpOMS\DataStorage\Database\Connection\SQLiteConnection;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\DataStorage\Database\Query\Builder;

use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Installer class.
 *
 * @package Modules\Admin\Admin
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class Installer extends InstallerAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function install(DatabasePool $dbPool, InfoManager $info) : void
    {
        parent::install($dbPool, $info);

        $sqlite = new SQLiteConnection([
            'db' => 'sqlite',
            'prefix' => '',
            'database' => __DIR__ . '/../../../phpOMS/Localization/Defaults/localization.sqlite',
        ]);

        self::installCountries($sqlite, $dbPool);
        self::installLanguages($sqlite, $dbPool);
        self::installCurrencies($sqlite, $dbPool);

        $sqlite->close();
    }

    /**
     * Install countries
     *
     * @param SQLiteConnection $sqlite SQLLite database connection of the source data
     * @param DatabasePool     $dbPool Database pool to save data to
     *
     * @return void
     *
     * @since 1.0.0
     */
    private static function installCountries(SQLiteConnection $sqlite, DatabasePool $dbPool) : void
    {
        $con = $dbPool->get();

        $query = new Builder($con);
        $query->prefix($con->getPrefix())
            ->insert('country_name', 'country_native', 'country_code2', 'country_code3', 'country_numeric')
            ->into('country');

        $querySqlite = new Builder($sqlite);
        $countries   = $querySqlite->select('*')->from('country')->execute();

        foreach ($countries as $country) {
            $query->values(
                $country['country_name'],
                $country['country_name'],
                $country['country_code2'],
                $country['country_code3'],
                $country['country_numeric']
            );
        }

        $query->execute();
    }

    /**
     * Install languages
     *
     * @param SQLiteConnection $sqlite SQLLite database connection of the source data
     * @param DatabasePool     $dbPool Database pool to save data to
     *
     * @return void
     *
     * @since 1.0.0
     */
    private static function installLanguages(SQLiteConnection $sqlite, DatabasePool $dbPool) : void
    {
        $con = $dbPool->get();

        $query = new Builder($con);
        $query->prefix($con->getPrefix())
            ->insert('language_name', 'language_native', 'language_639_2T', 'language_639_2B', 'language_639_3')
            ->into('language');

        $querySqlite = new Builder($sqlite);
        $languages   = $querySqlite->select('*')->from('language')->execute();

        foreach ($languages as $language) {
            $query->values(
                $language['language_name'],
                $language['language_native'],
                $language['language_639_2T'],
                $language['language_639_2B'],
                $language['language_639_3']
            );
        }

        $query->execute();
    }

    /**
     * Install currencies
     *
     * @param SQLiteConnection $sqlite SQLLite database connection of the source data
     * @param DatabasePool     $dbPool Database pool to save data to
     *
     * @return void
     *
     * @since 1.0.0
     */
    private static function installCurrencies(SQLiteConnection $sqlite, DatabasePool $dbPool) : void
    {
        $con = $dbPool->get();

        $query = new Builder($con);
        $query->prefix($con->getPrefix())
            ->insert('currency_id', 'currency_name', 'currency_char', 'currency_number', 'currency_symbol', 'currency_subunits', 'currency_decimals', 'currency_countries')
            ->into('currency');

        $querySqlite = new Builder($sqlite);
        $currencies  = $querySqlite->select('*')->from('currency')->execute();

        foreach ($currencies as $currency) {
            $query->values(
                $currency['currency_id'],
                $currency['currency_name'],
                $currency['currency_char'],
                $currency['currency_number'],
                $currency['currency_symbol'],
                $currency['currency_subunits'],
                $currency['currency_decimals'],
                $currency['currency_countries']
            );
        }

        $query->execute();
    }
}
