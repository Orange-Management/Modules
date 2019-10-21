<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\HumanResourceTimeRecording\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\HumanResourceTimeRecording\Models;

use Modules\HumanResourceManagement\Models\EmployeeMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\RelationType;
use phpOMS\Stdlib\Base\SmartDateTime;

/**
 * Mapper class.
 *
 * @package Modules\HumanResourceTimeRecording\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class SessionMapper extends DataMapperAbstract
{

    /**
     * Columns.
     *
     * @var   array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'hr_timerecording_session_id'       => ['name' => 'hr_timerecording_session_id',       'type' => 'int',      'internal' => 'id'],
        'hr_timerecording_session_type'     => ['name' => 'hr_timerecording_session_type',     'type' => 'int',      'internal' => 'type'],
        'hr_timerecording_session_start'    => ['name' => 'hr_timerecording_session_start',    'type' => 'DateTime', 'internal' => 'start'],
        'hr_timerecording_session_end'      => ['name' => 'hr_timerecording_session_end',      'type' => 'DateTime', 'internal' => 'end'],
        'hr_timerecording_session_busy'     => ['name' => 'hr_timerecording_session_busy',     'type' => 'int',      'internal' => 'busy'],
        'hr_timerecording_session_employee' => ['name' => 'hr_timerecording_session_employee', 'type' => 'int',      'internal' => 'employee'],
    ];

    /**
     * Has many relation.
     *
     * @var   array<string, array<string, null|string>>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'sessionElements' => [
            'mapper' => SessionElementMapper::class,
            'table'  => 'hr_timerecording_session_element',
            'dst'    => 'hr_timerecording_session_element_session',
            'src'    => null,
        ],
    ];

    /**
     * Belongs to.
     *
     * @var   array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'employee' => [
            'mapper' => EmployeeMapper::class,
            'src'    => 'hr_timerecording_session_employee',
        ],
    ];

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'hr_timerecording_session';

    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'hr_timerecording_session_id';

    /**
     * Created at column
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $createdAt = 'hr_timerecording_session_start';

    /**
     * Get last sessions from all employees
     *
     * @return Session[]
     *
     * @todo: consider selecting only active employees
     * @todo: consider using a datetime to limit the results to look for
     *
     * @since 1.0.0
     */
    public static function getLastSessionsFromAllEmployees(\DateTime $dt = null) : array
    {
        $join = new Builder(self::$db);
        $join->prefix(self::$db->getPrefix())
            ->select(self::$table . '.hr_timerecording_session_employee')
            ->selectAs('MAX(hr_timerecording_session_start)', 'maxDate')
            ->from(self::$table)
            ->groupBy(self::$table . '.hr_timerecording_session_employee');

        $query = new Builder(self::$db);
        $query->prefix(self::$db->getPrefix())
            ->select('*')->fromAs(self::$table, 't')
            ->innerJoin($join, 'tm')
            ->on('t.hr_timerecording_session_employee', '=', 'tm.hr_timerecording_session_employee')
            ->andOn('t.hr_timerecording_session_start', '=', 'tm.maxDate');

        return self::getAllByQuery($query, RelationType::ALL, 6);
    }

    /**
     * Get the most plausible open session for an employee.
     *
     * This searches for an open session that could be ongoing. This is required to automatically select
     * the current session for breaks, work continuation and ending work sessions without manually selecting
     * the current session.
     *
     * @param int $employee Employee id
     *
     * @return null|Session
     *
     * @since 1.0.0
     */
    public static function getMostPlausibleOpenSessionForEmployee(int $employee) : ?Session
    {
        $dt = new SmartDateTime('now');
        $dt->smartModify(0, 0, -32);

        $query = self::getQuery();
        $query->where(self::$table.'.hr_timerecording_session_employee', '=', $employee)
            ->andWhere(self::$table.'.hr_timerecording_session_start', '>', $dt)
            ->orderBy(self::$table.'.hr_timerecording_session_start', 'DESC')
            ->limit(1);

        /** @var Session[] $session */
        $sessions = self::getAllByQuery($query, RelationType::ALL, 6);

        if (empty($sessions)) {
            return null;
        }

        if (\end($sessions)->getEnd() === null) {
            return \end($sessions);
        }

        return null;
    }

    /**
     * Get newest sessions for employee
     *
     * @param int       $employee Employee to get the sessions for
     * @param \DateTime $start    Sessions after this date
     */
    public static function getNewestForEmployee(int $employee, \DateTime $start) : array
    {
        $query = new Builder(self::$db);
        $query = self::getQuery($query)
            ->where(self::$table . '.hr_timerecording_session_employee', '=', $employee)
            ->andWhere(self::$table . '.' . self::$createdAt, '>', $start->format('Y-m-d'))
            ->orderBy(self::$table . '.' . self::$createdAt, 'DESC');

        $sth = self::$db->con->prepare($query->toSql());
        $sth->execute();

        $results = $sth->fetchAll(\PDO::FETCH_ASSOC);
        $obj     = self::populateIterable($results === false ? [] : $results);

        self::fillRelations($obj, RelationType::ALL, 6);
        self::clear();

        return $obj;
    }
}
