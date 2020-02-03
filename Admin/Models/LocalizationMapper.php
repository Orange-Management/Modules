<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Admin\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\Localization\Defaults\CountryMapper;
use phpOMS\Localization\Defaults\CurrencyMapper;
use phpOMS\Localization\Defaults\LanguageMapper;

/**
 * Localization mapper.
 *
 * @package Modules\Admin\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class LocalizationMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string|array>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'l11n_id'              => ['name' => 'l11n_id',              'type' => 'int',     'internal' => 'id'],
        'l11n_country'         => ['name' => 'l11n_country',         'type' => 'int',     'internal' => 'country'],
        'l11n_language'        => ['name' => 'l11n_language',        'type' => 'int',     'internal' => 'language'],
        'l11n_currency'        => ['name' => 'l11n_currency',        'type' => 'int',     'internal' => 'currency'],
        'l11n_datetime'        => ['name' => 'l11n_datetime',        'type' => 'int',     'internal' => 'datetime'],
        'l11n_number_thousand' => ['name' => 'l11n_number_thousand', 'type' => 'string',  'internal' => 'thousands'],
        'l11n_number_decimal'  => ['name' => 'l11n_number_decimal',  'type' => 'string',  'internal' => 'decimal'],
        'l11n_angle'           => ['name' => 'l11n_angle',           'type' => 'string',  'internal' => 'angle'],
        'l11n_temperature'     => ['name' => 'l11n_temperature',     'type' => 'string',  'internal' => 'temperature'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'country'  => [
            'mapper' => CountryMapper::class,
            'src'    => 'l11n_country',
        ],
        'language'    => [
            'mapper' => LanguageMapper::class,
            'src'    => 'l11n_language',
        ],
        'currency'    => [
            'mapper' => CurrencyMapper::class,
            'src'    => 'l11n_currency',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'l11n_id';
}
