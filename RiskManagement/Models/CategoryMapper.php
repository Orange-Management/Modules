<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\RiskManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Risk category mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class CategoryMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'riskmngmt_category_id'             => ['name' => 'riskmngmt_category_id',             'type' => 'int',    'internal' => 'id'],
        'riskmngmt_category_name'           => ['name' => 'riskmngmt_category_name',           'type' => 'string', 'internal' => 'title'],
        'riskmngmt_category_description'    => ['name' => 'riskmngmt_category_description',    'type' => 'string', 'internal' => 'description'],
        'riskmngmt_category_descriptionraw' => ['name' => 'riskmngmt_category_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_category_parent'         => ['name' => 'riskmngmt_category_parent',         'type' => 'int',    'internal' => 'parent'],
        'riskmngmt_category_responsible'    => ['name' => 'riskmngmt_category_responsible',    'type' => 'int',    'internal' => 'responsible'],
        'riskmngmt_category_deputy'         => ['name' => 'riskmngmt_category_deputy',         'type' => 'int',    'internal' => 'deputy'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'riskmngmt_category';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'riskmngmt_category_id';
}
