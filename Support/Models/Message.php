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
class Message
{
    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private \DateTime $created;

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    private ?int $creator = null;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->created = new \DateTime('now');
    }

    /**
     * Get id.
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
     * Get name/title.
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
     * Set name.
     *
     * @param string $name Name/title
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
     * Get created.
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreated() : \DateTime
    {
        return $this->created;
    }

    /**
     * Set created.
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreated($created) : void
    {
        $this->created = $created;
    }

    /**
     * Get creator.
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
     * Set creator.
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
