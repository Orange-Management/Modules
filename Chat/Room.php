<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Chat
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Chat;

/**
 * Room class.
 *
 * @package Modules\Chat
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Room
{

    /**
     * Room ID.
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

    /**
     * Type.
     *
     * @var   \Modules\Chat\RoomType
     * @since 1.0.0
     */
    private $room_type = null;

    /**
     * Password.
     *
     * @var   string
     * @since 1.0.0
     */
    private ?string $password = null;

    /**
     * Get the id
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param string $name Name
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * Get the description
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set the description
     *
     * @param string $desc Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription(string $desc) : void
    {
        $this->description = $desc;
    }

    /**
     * Get created at
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get the creator
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set the creator
     *
     * @param mixed $creator Creator
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreator($creator) : void
    {
        $this->creator = $creator;
    }
}
