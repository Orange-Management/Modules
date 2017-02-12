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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Media\Models;

/**
 * Media class.
 *
 * @category   Modules
 * @package    Modules\Media
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Media
{

    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected $id = 0;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    protected $name = '';

    /**
     * Extension.
     *
     * @var string
     * @since 1.0.0
     */
    protected $extension = '';

    /**
     * File size in bytes.
     *
     * @var int
     * @since 1.0.0
     */
    protected $size = 0;

    /**
     * Author.
     *
     * @var int
     * @since 1.0.0
     */
    protected $createdBy = 0;

    /**
     * Uploaded.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected $createdAt = null;

    /**
     * Resource path.
     *
     * @var string
     * @since 1.0.0
     */
    protected $path = '';

    /**
     * Is versioned.
     *
     * @var bool
     * @since 1.0.0
     */
    protected $versioned = false;

    /**
     * Media Description.
     *
     * @var string
     * @since 1.0.0
     */
    protected $description = '';

    /**
     * Permissions.
     *
     * @var array
     * @since 1.0.0
     */
    protected $permissions = [
        'r' => ['groups' => [],
                'users'  => [],],
        'w' => ['groups' => [],
                'users'  => [],],
        'p' => ['groups' => [],
                'users'  => [],],
        'd' => ['groups' => [],
                'users'  => [],],
    ];

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreatedBy() : int
    {
        return $this->createdBy;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt ?? new \DateTime('now');
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getExtension() : string
    {
        return $this->extension;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getSize() : int
    {
        return $this->size;
    }

    /**
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function isVersioned() : bool
    {
        return $this->versioned;
    }

    /**
     * @param int $createdBy Creator
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreatedBy(int $createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @param \DateTime $createdAt Creation date
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param string $extension Extension
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setExtension(string $extension)
    {
        $this->extension = $extension;
    }

    /**
     * @param string $path $filepath
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param string $name Media name (not file name)
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description Media description
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @param int $size Filesize
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setSize(int $size)
    {
        $this->size = $size;
    }

    /**
     * @param bool $versioned File is version controlled
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setVersioned(bool $versioned)
    {
        $this->versioned = $versioned;
    }

    public function toArray()
    {
        return [];
    }
}
