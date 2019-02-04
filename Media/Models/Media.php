<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Media\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Media\Models;

/**
 * Media class.
 *
 * @package    Modules\Media\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Media implements \JsonSerializable
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
     * Is path absolute?
     *
     * @var bool
     * @since 1.0.0
     */
    protected $isAbsolute = false;

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
    protected $description    = '';
    protected $descriptionRaw = '';

    /**
     * Constructor.
     *
     * @since  1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     *
     * @since  1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return bool
     *
     * @since  1.0.0
     */
    public function isAbsolute() : bool
    {
        return $this->isAbsolute;
    }

    /**
     * @return void
     *
     * @since  1.0.0
     */
    public function setAbsolute(bool $absolute) : void
    {
        $this->isAbsolute = $absolute;
    }

    /**
     * @return int|\phpOMS\Account\Account
     *
     * @since  1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt ?? new \DateTime('now');
    }

    /**
     * @return string
     *
     * @since  1.0.0
     */
    public function getExtension() : string
    {
        return $this->extension;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     */
    public function getSize() : int
    {
        return $this->size;
    }

    /**
     * @return bool
     *
     * @since  1.0.0
     */
    public function isVersioned() : bool
    {
        return $this->versioned;
    }

    /**
     * @param mixed $createdBy Creator
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
     * @param string $extension Extension
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setExtension(string $extension) : void
    {
        $this->extension = $extension;
    }

    /**
     * @param string $path $filepath
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setPath(string $path) : void
    {
        $this->path = \str_replace('\\', '/', $path);
    }

    /**
     * @param string $name Media name (not file name)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * @param string $description Media description
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
     * @param string $description Media description
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
     * @param int $size Filesize
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setSize(int $size) : void
    {
        $this->size = $size;
    }

    /**
     * @param bool $versioned File is version controlled
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setVersioned(bool $versioned) : void
    {
        $this->versioned = $versioned;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'extension'   => $this->extension,
            'size'        => $this->size,
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
