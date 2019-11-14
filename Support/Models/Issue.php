<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Support\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Support\Models;

/**
 * Issue class.
 *
 * @package Modules\Support\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Issue
{
    /**
     * Id.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Name.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Description.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Created.
     *
     * @var   null|\DateTime
     * @since 1.0.0
     */
    private ?\DateTime $created = null;

    /**
     * Creator.
     *
     * @var   int
     * @since 1.0.0
     */
    private ?int $creator = null;

    private static $instances = [];

    public function getInstance($id)
    {
        if (!isset(self::$instances[$id])) {
            self::$instances[$id] = new self($id);
        }

        return self::$instances[$id];
    }

    public function init($id) : void
    {
    }

    public function __clone()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name) : void
    {
        $this->name = $name;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created) : void
    {
        $this->created = $created;
    }

    public function getCreator()
    {
        return $this->creator;
    }

    public function setCreator($creator) : void
    {
        $this->creator = $creator;
    }

    public function delete() : void
    {
    }

    public function create() : void
    {
    }

    public function update() : void
    {
    }

    public function serialize() : void
    {
    }

    public function unserialize($data) : void
    {
    }
}
