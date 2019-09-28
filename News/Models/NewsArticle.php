<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\News\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\News\Models;

use phpOMS\Contract\ArrayableInterface;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Stdlib\Base\Exception\InvalidEnumValue;

/**
 * News article class.
 *
 * @package Modules\News\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class NewsArticle implements ArrayableInterface, \JsonSerializable
{

    /**
     * Article ID.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Title.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $title = '';

    /**
     * Content.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $content = '';

    /**
     * Unparsed.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $plain = '';

    /**
     * News type.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $type = NewsType::ARTICLE;

    /**
     * News status.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $status = NewsStatus::DRAFT;

    /**
     * Language.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $language = ISO639x1Enum::_EN;

    /**
     * Created.
     *
     * @var   \DateTime
     * @since 1.0.0
     */
    private \DateTime $createdAt;

    /**
     * Creator.
     *
     * @var   int
     * @since 1.0.0
     */
    private $createdBy = 0;

    /**
     * Publish.
     *
     * @var   \DateTime
     * @since 1.0.0
     */
    private \DateTime $publish;

    /**
     * Featured.
     *
     * @var   bool
     * @since 1.0.0
     */
    private bool $featured = false;

    /**
     * Badge.
     *
     * @var   array
     * @since 1.0.0
     */
    private array $badges = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->publish   = new \DateTime('now');
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
     * @param mixed $badge Badge to add
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
     * Get content
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
     * Set content
     *
     * @param string $content News article content
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
     * Set plain content
     *
     * @param string $plain Plain/raw content
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setPlain(string $plain) : void
    {
        $this->plain = $plain;
    }

    /**
     * Get plain/raw content
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getPlain() : string
    {
        return $this->plain;
    }

    /**
     * Get date of creation
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
     * Get id
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
     * Get news language
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
     * Get publish date
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getPublish() : \DateTime
    {
        return $this->publish;
    }

    /**
     * Set language
     *
     * @param string $language News article language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setLanguage(string $language) : void
    {
        if (!ISO639x1Enum::isValidValue($language)) {
            throw new InvalidEnumValue($language);
        }

        $this->language = $language;
    }

    /**
     * Set publish date
     *
     * @param \DateTime $publish Publish date
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setPublish(\DateTime $publish) : void
    {
        $this->publish = $publish;
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
     * Set created by
     *
     * @param int $id Created by
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
     * @return string
     *
     * @since 1.0.0
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Set news article title
     *
     * @param string $title News article title
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
     * Get news article type
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * Set news article type
     *
     * @param int $type News article type
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setType(int $type) : void
    {
        if (!NewsType::isValidValue($type)) {
            throw new InvalidEnumValue((string) $type);
        }

        $this->type = $type;
    }

    /**
     * Get news article status
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
     * @param int $status News status
     *
     * @return void
     *
     * @throws InvalidEnumValue
     *
     * @since 1.0.0
     */
    public function setStatus(int $status) : void
    {
        if (!NewsStatus::isValidValue($status)) {
            throw new InvalidEnumValue((string) $status);
        }

        $this->status = $status;
    }

    /**
     * @return bool
     *
     * @since 1.0.0
     */
    public function isFeatured() : bool
    {
        return $this->featured;
    }

    /**
     * Set featured
     *
     * @param bool $featured Is featured
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setFeatured(bool $featured) : void
    {
        $this->featured = $featured;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'plain' => $this->plain,
            'content' => $this->content,
            'type' => $this->type,
            'status' => $this->status,
            'featured' => $this->featured,
            'publish' => $this->publish->format('Y-m-d H:i:s'),
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'createdBy' => $this->createdBy,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) \json_encode($this->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
