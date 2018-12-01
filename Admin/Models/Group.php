<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

/**
 * Account group class.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class Group extends \phpOMS\Account\Group
{
    /**
     * Created at.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected $createdAt = null;

    /**
     * Created by.
     *
     * @var int
     * @since 1.0.0
     */
    protected $createdBy = 0;

    /**
     * Group raw description.
     *
     * @var string
     * @since 1.0.0
     */
    protected $descriptionRaw = '';

    /**
     * Accounts
     *
     * @var array
     * @since 1.0.0
     */
    protected $accounts = [];

    /**
     * Constructor
     *
     * @since  1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get created at.
     *
     * @return \DateTime
     *
     * @since  1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt ?? new \DateTime('NOW');
    }

    /**
     * Get created by.
     *
     * @return mixed
     *
     * @since  1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set created by
     *
     * @param mixed $createdBy Group created by
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setCreatedBy($createdBy) : void
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
     * @since  1.0.0
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
     * @since  1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * Get accounts
     *
     * @return array Accounts
     *
     * @since  1.0.0
     */
    public function getAccounts() : array
    {
        return $this->accounts;
    }
}
