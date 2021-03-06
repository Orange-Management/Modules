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

use Modules\Admin\Models\Account;

/**
 * Task relation to account
 *
 * @package Modules\Tasks\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class AccountRelation extends RelationAbstract
{
    /**
     * Relation object
     *
     * @var int|Account
     * @since 1.0.0
     */
    private $relation = null;

    /**
     * Constructor.
     *
     * @param int|Account $account Account
     * @param int         $duty    Duty type
     *
     * @since 1.0.0
     */
    public function __construct($account = 0, int $duty = DutyType::TO)
    {
        $this->relation = $account;
        $this->duty     = $duty;
    }

    /**
     * Get relation object.
     *
     * @return int|Account
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
