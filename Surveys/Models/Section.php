<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Surveys
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Surveys\Models;

/**
 * Section class.
 *
 * @package    Modules\Surveys
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Section
{

    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($desc) : void
    {
        $this->description = $desc;
    }

    /**
     * 
     */
    public function delete() : void
    {
    }

    /**
     * 
     */
    public function create() : void
    {
    }

    /**
     * 
     */
    public function update() : void
    {
    }

    /**
     * 
     */
    public function serialize() : void
    {
    }

    /**
     * 
     */
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
