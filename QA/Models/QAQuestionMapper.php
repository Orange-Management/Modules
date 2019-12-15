<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\QA\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\QA\Models;

use Modules\Profile\Models\ProfileMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\QA\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class QAQuestionMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var   array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'qa_question_id'         => ['name' => 'qa_question_id',         'type' => 'int',      'internal' => 'id'],
        'qa_question_title'      => ['name' => 'qa_question_title',      'type' => 'string',   'internal' => 'name'],
        'qa_question_language'   => ['name' => 'qa_question_language',   'type' => 'string',   'internal' => 'language'],
        'qa_question_question'   => ['name' => 'qa_question_question',   'type' => 'string',   'internal' => 'question'],
        'qa_question_status'     => ['name' => 'qa_question_status',     'type' => 'int',      'internal' => 'status'],
        'qa_question_category'   => ['name' => 'qa_question_category',   'type' => 'int',      'internal' => 'category'],
        'qa_question_created_by' => ['name' => 'qa_question_created_by', 'type' => 'int',      'internal' => 'createdBy'],
        'qa_question_created_at' => ['name' => 'qa_question_created_at', 'type' => 'DateTime', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var   array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'answers' => [
            'mapper' => QAAnswerMapper::class,
            'table'  => 'qa_answer',
            'dst'    => 'qa_answer_question',
            'src'    => null,
        ],
    ];

    /**
     * Has many relation.
     *
     * @var   array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $ownsOne = [
        'category' => [
            'mapper' => QACategoryMapper::class,
            'dst'    => 'qa_question_category',
        ],
    ];

    /**
     * Belongs to.
     *
     * @var   array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'createdBy' => [
            'mapper' => ProfileMapper::class,
            'dest'   => 'qa_question_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'qa_question';

    /**
     * Created at.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $createdAt = 'qa_question_created_at';

    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'qa_question_id';
}
