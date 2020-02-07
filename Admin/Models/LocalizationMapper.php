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
use phpOMS\DataStorage\Database\RelationType;
use phpOMS\Localization\Defaults\CountryMapper;
use phpOMS\Localization\Defaults\CurrencyMapper;
use phpOMS\Localization\Defaults\LanguageMapper;
use phpOMS\Localization\Localization;

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
            'self'   => 'l11n_country',
            'by'     => 'code2',
        ],
        'language'    => [
            'mapper' => LanguageMapper::class,
            'self'   => 'l11n_language',
            'by'     => 'code2',
        ],
        'currency'    => [
            'mapper' => CurrencyMapper::class,
            'self'   => 'l11n_currency',
            'by'     => 'code',
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

    /**
     * Model to use by the mapper.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $model = Localization::class;

    /**
     * Get object.
     *
     * @param mixed $primaryKey Key
     * @param int   $relations  Load relations
     * @param mixed $fill       Object to fill
     * @param int   $depth      Relation depth
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public static function get($primaryKey, int $relations = RelationType::ALL, $fill = null, int $depth = 1)
    {
        return parent::get($primaryKey, $relations, $fill, 1);
    }
}
