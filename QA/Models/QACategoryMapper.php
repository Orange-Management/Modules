<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\QA\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\QA\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package    Modules\QA\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class QACategoryMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'qa_category_id'     => ['name' => 'qa_category_id', 'type' => 'int', 'internal' => 'id'],
        'qa_category_name'   => ['name' => 'qa_category_name', 'type' => 'string', 'internal' => 'name'],
        'qa_category_parent' => ['name' => 'qa_category_parent', 'type' => 'int', 'internal' => 'parent'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'qa_category';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'qa_category_id';
}
