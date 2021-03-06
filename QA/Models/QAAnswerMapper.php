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

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\QA\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class QAAnswerMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'qa_answer_id'         => ['name' => 'qa_answer_id',         'type' => 'int',      'internal' => 'id'],
        'qa_answer_answer'     => ['name' => 'qa_answer_answer',     'type' => 'string',   'internal' => 'answer'],
        'qa_answer_question'   => ['name' => 'qa_answer_question',   'type' => 'int',      'internal' => 'question'],
        'qa_answer_status'     => ['name' => 'qa_answer_status',     'type' => 'int',      'internal' => 'status'],
        'qa_answer_accepted'   => ['name' => 'qa_answer_accepted',   'type' => 'bool',     'internal' => 'isAccepted'],
        'qa_answer_created_by' => ['name' => 'qa_answer_created_by', 'type' => 'int',      'internal' => 'createdBy', 'readonly' => true],
        'qa_answer_created_at' => ['name' => 'qa_answer_created_at', 'type' => 'DateTime', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, self:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'createdBy' => [
            'mapper' => AccountMapper::class,
            'self'   => 'qa_answer_created_by',
        ],
        'question' => [
            'mapper' => QAQuestionMapper::class,
            'self'   => 'qa_answer_question',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'qa_answer';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'qa_answer_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'qa_answer_id';
}
