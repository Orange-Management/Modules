<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Organization\Models;

use phpOMS\Contract\ArrayableInterface;

class Position implements ArrayableInterface, \JsonSerializable
{
    private $id = 0;

    private $name = '';

    private $parent = null;

    private $description = '';

    protected $status = Status::INACTIVE;

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(int $parent)
    {
        $this->parent = $parent;
    }

    public function getStatus() : int
    {
        return $this->status;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $desc)
    {
        $this->description = $desc;
    }

    public function toArray() : array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
        ];
    }

    /**
     * Get string representation.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __toString()
    {
        return $this->jsonSerialize();
    }

    /**
     * Json serialize.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function jsonSerialize()
    {
        return json_encode($this->toArray());
    }
}
