<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Address\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Address\Admin;

use phpOMS\DataStorage\Database\Connection\SQLiteConnection;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\DataStorage\Database\Query\Builder;

use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Installer class.
 *
 * @package Modules\Address\Admin
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Installer extends InstallerAbstract
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
            'database' => __DIR__ . '/../../../phpOMS/Localization/Defaults/localization.sqlite'
        ]);

        self::installCountries($sqlite, $dbPool);

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
            ->insert('country_name', 'country_native', 'country_code2', 'country_code3', 'country_codenum')
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
}
