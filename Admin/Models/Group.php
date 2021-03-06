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

/**
 * Account group class.
 *
 * @package Modules\Admin\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Group extends \phpOMS\Account\Group
{
    /**
     * Created at.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected \DateTime $createdAt;

    /**
     * Created by.
     *
     * @var Account
     * @since 1.0.0
     */
    protected Account $createdBy;

    /**
     * Group raw description.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $descriptionRaw = '';

    /**
     * Accounts
     *
     * @var Account[]
     * @since 1.0.0
     */
    protected array $accounts = [];

    /**
     * Constructor
     *
     * @param string $name Group name
     *
     * @since 1.0.0
     */
    public function __construct(string $name = '')
    {
        $this->createdBy = new NullAccount();
        $this->createdAt = new \DateTime('now');
        $this->setName($name);
    }

    /**
     * Get created at.
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Get created by.
     *
     * @return Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy() : Account
    {
        return $this->createdBy;
    }

    /**
     * Set created by
     *
     * @param Account $createdBy Group created by
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy(Account $createdBy) : void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * Set raw description
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescriptionRaw(string $description) : void
    {
        $this->descriptionRaw = $description;
    }

    /**
     * Get raw description
     *
     * @return string Raw description
     *
     * @since 1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * Get accounts
     *
     * @return Account[] Accounts
     *
     * @since 1.0.0
     */
    public function getAccounts() : array
    {
        return $this->accounts;
    }
}
