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

use Modules\Tag\Models\Tag;

/**
 * Wiki document class.
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
     * @var null|WikiApp
     * @since 1.0.0
     */
    private ?WikiApp $app = null;

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
     * @var null|WikiCategory
     * @since 1.0.0
     */
    private ?WikiCategory $category = null;

    /**
     * Language.
     *
     * @var string
     * @since 1.0.0
     */
    private string $language = 'en';

    /**
     * Tags.
     *
     * @var Tag[]
     * @since 1.0.0
     */
    private array $tags = [];

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
     * @return WikiApp
     *
     * @since 1.0.0
     */
    public function getApp() : WikiApp
    {
        return $this->app ?? new NullWikiApp();
    }

    /**
     * Set app
     *
     * @param null|WikiApp $app App
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setApp(?WikiApp $app) : void
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
     * @return WikiCategory
     *
     * @since 1.0.0
     */
    public function getCategory() : WikiCategory
    {
        return $this->category ?? new NullWikiCategory();
    }

    /**
     * Set cateogry
     *
     * @param null|WikiCategory $category Category
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCategory(?WikiCategory $category) : void
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
     * @param Tag $tag Tag
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addTag(Tag $tag) : void
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
