<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Comments\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Comments\Models;

/**
 * Task class.
 *
 * @package Modules\Comments\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Comment
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    private $createdBy = 0;

    /**
     * Created at
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private \DateTime $createdAt;

    /**
     * Comment list this comment belongs to
     *
     * @var int
     * @since 1.0.0
     */
    private $list = 0;

    /**
     * Title
     *
     * @var string
     * @since 1.0.0
     */
    private $title = '';

    private int $status = 0;

    /**
     * Content
     *
     * @var string
     * @since 1.0.0
     */
    private $content = '';

    /**
     * Content raw
     *
     * @var string
     * @since 1.0.0
     */
    private $contentRaw = '';

    private $ref = null;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id.
     *
     * @return int Model id
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Reference id
     *
     * @param mixed $ref Reference
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setRef($ref) : void
    {
        $this->ref = $ref;
    }

    /**
     * Get the reference
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set the list this comment belongs to
     *
     * @param int $list List
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setList(int $list) : void
    {
        $this->list = $list;
    }

    /**
     * Get the list this comment belongs to
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getList() : int
    {
        return $this->list;
    }

    /**
     * Get the title
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Set the title
     *
     * @param string $title Title
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    /**
     * Get the content
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * Get the content
     *
     * @param string $content Content
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setContent(string $content) : void
    {
        $this->content = $content;
    }

    /**
     * Get the raw content
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getContentRaw() : string
    {
        return $this->contentRaw;
    }

    /**
     * Set the raw content
     *
     * @param string $contentRaw Content
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setContentRaw(string $contentRaw) : void
    {
        $this->contentRaw = $contentRaw;
    }

    /**
     * Get created by
     *
     * @return int|\phpOMS\Account\Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set the creator
     *
     * @param mixed $createdBy Creator
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy($createdBy) : void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * Get created at date time
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : array
    {
        return [];
    }
}
