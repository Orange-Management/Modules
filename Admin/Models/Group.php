<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    Modules\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types = 1);

namespace Modules\Admin\Models;

/**
 * Account group class.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Group extends \phpOMS\Account\Group
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
     * Constructor
     *
     * @since  1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();

        parent::__construct();
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
     * @return int
     *
     * @since  1.0.0
     */
    public function getCreatedBy() : int
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
    public function setCreatedBy($createdBy) /* : void */
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
    public function setDescriptionRaw(string $description) /* : void */
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
}
