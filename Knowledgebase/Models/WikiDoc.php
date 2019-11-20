<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Knowledgebase\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Knowledgebase\Models;

/**
 * Task class.
 *
 * @package Modules\Knowledgebase\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class WikiDoc implements \JsonSerializable
{
    /**
     * ID.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Name.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $name = '';

    private int $status = WikiStatus::ACTIVE;

    private $doc = '';

    private $category = 0;

    private $language = '';

    private $createdBy = 0;

    private $createdAt = null;

    private $badges = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
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
     * Get language
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getLanguage() : string
    {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param string $language Language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setLanguage(string $language) : void
    {
        $this->language = $language;
    }

    /**
     * Get name
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
     * Set name
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
     * Get content
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDoc() : string
    {
        return $this->doc;
    }

    /**
     * Set content
     *
     * @param string $doc Document content
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDoc(string $doc) : void
    {
        $this->doc = $doc;
    }

    /**
     * Get status
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param int $status Status
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setStatus(int $status) : void
    {
        $this->status = $status;
    }

    /**
     * Get category
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set cateogry
     *
     * @param int $category Category
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCategory(int $category) : void
    {
        $this->category = $category;
    }

    /**
     * Get created by
     *
     * @return int|\phpOMS\Account\Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy() : int
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
     * @since 1.0.0
     */
    public function setCreatedBy($id) : void
    {
        $this->createdBy = $id;
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
     * Get badges
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getBadges() : array
    {
        return $this->badges;
    }

    /**
     * Add badge
     *
     * @param mixed $badge Badge
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addBadge($badge) : void
    {
        $this->badges[] = $badge;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : array
    {
        return [];
    }
}
