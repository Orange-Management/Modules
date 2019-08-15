<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Support
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Support\Models;

/**
 * Issue class.
 *
 * @package    Modules\Support
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class Message
{

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    private $name = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private $description = '';

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $created = null;

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    private $creator = null;

    private static $instances = [];

    public function getInstance($id)
    {
        if (!isset(self::$instances[$id])) {
            self::$instances[$id] = new self($id);
        }

        return self::$instances[$id];
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

    /**
     * Init object by ID.
     *
     * This usually happens from DB or cache
     *
     * @param int $id Object ID
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function init($id) : void
    {
        // TODO: Implement init() method.
    }

    /**
     * Overwriting clone in order to maintain singleton pattern.
     *
     * @since  1.0.0
     */
    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}
