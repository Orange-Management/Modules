<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Tasks\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tasks\Models;

use Modules\Admin\Models\Group;

/**
 * Task relation to group
 *
 * @package Modules\Tasks\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class GroupRelation extends RelationAbstract
{
    /**
     * Relation object
     *
     * @var   int|Group
     * @since 1.0.0
     */
    private $relation = null;

    /**
     * Constructor.
     *
     * @param int|Group $group Group
     * @param int       $duty  Duty type
     *
     * @since 1.0.0
     */
    public function __construct($group = 0, int $duty = DutyType::TO)
    {
        $this->relation = $group;
        $this->duty     = $duty;
    }

    /**
     * Get relation object.
     *
     * @return int|Group
     *
     * @since 1.0.0
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'       => $this->id,
            'duty'     => $this->duty,
            'relation' => $this->relation,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
