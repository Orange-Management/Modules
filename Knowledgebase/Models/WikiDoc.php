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
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * App id.
     *
     * There can be different wikis
     *
     * @var null|int|WikiApp
     * @since 1.0.0
     */
    private $app = null;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Article status.
     *
     * @var int
     * @since 1.0.0
     */
    private int $status = WikiStatus::ACTIVE;

    /**
     * Document content.
     *
     * @var string
     * @since 1.0.0
     */
    private string $doc = '';

    /**
     * Document raw content.
     *
     * @var string
     * @since 1.0.0
     */
    private string $docRaw = '';

    /**
     * Category.
     *
     * @var int|WikiCategory
     * @since 1.0.0
     */
    private $category = 0;

    /**
     * Language.
     *
     * @var string
     * @since 1.0.0
     */
    private $language = 'en';

    /**
     * Tags.
     *
     * @var array
     * @since 1.0.0
     */
    private $tags = [];

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
     * Get app
     *
     * @return null|int|WikiApp
     *
     * @since 1.0.0
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Set app
     *
     * @param int $app App
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setApp(int $app) : void
    {
        $this->app = $app;
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
     * Get content
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDocRaw() : string
    {
        return $this->docRaw;
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
    public function setDocRaw(string $doc) : void
    {
        $this->docRaw = $doc;
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
     * Get tags
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getTags() : array
    {
        return $this->tags;
    }

    /**
     * Add tag
     *
     * @param mixed $tag Tag
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addTag($tag) : void
    {
        $this->tags[] = $tag;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : array
    {
        return [];
    }
}
