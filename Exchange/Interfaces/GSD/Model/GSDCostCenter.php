<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Exchange\Interfaces\GSD\Model
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Exchange\Interfaces\GSD\Model;

/**
 * Cost center class.
 *
 * @package    Modules\Exchange\Interfaces\GSD\Model
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class GSDCostCenter implements \JsonSerializable
{

    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected $id = 0;

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    protected $createdBy = 0;

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected $createdAt = null;

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    protected $description = '';

    /**
     * Cost center.
     *
     * @var string
     * @since 1.0.0
     */
    protected $costCenter = '';

    /**
     * Constructor.
     *
     * @since  1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt ?? new \DateTime();
    }

    /**
     * Get created by
     *
     * @return int|\phpOMS\Account\Account
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
     * @param mixed $id Created by
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setCreatedBy($id) : void
    {
        $this->createdBy = $id;
    }

    /**
     * Set description
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

     /**
     * Set cost center
     *
     * @param string $costCenter Cost center
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setCostCenter(string $costCenter) : void
    {
        $this->costCenter = $costCenter;
    }

    /**
     * Get cost center
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function getCostCenter() : string
    {
        return $this->costCenter;
    }

    /**
     * Get id
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'createdBy' => $this->createdBy,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'description' => $this->description,
            'costcenter' => $this->costCenter,
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
