<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\News\Models;

use phpOMS\Contract\ArrayableInterface;
use phpOMS\Datatypes\Exception\InvalidEnumValue;
use phpOMS\Localization\ISO639x1Enum;

/**
 * News article class.
 *
 * @category   Module
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class NewsArticle implements ArrayableInterface, \JsonSerializable
{

    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    private $title = '';

    /**
     * Content.
     *
     * @var string
     * @since 1.0.0
     */
    private $content = '';

    /**
     * Unparsed.
     *
     * @var string
     * @since 1.0.0
     */
    private $plain = '';

    /**
     * News type.
     *
     * @var int
     * @since 1.0.0
     */
    private $type = NewsType::ARTICLE;

    /**
     * News status.
     *
     * @var int
     * @since 1.0.0
     */
    private $status = NewsStatus::DRAFT;

    /**
     * Language.
     *
     * @var string
     * @since 1.0.0
     */
    private $language = ISO639x1Enum::_EN;

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $createdAt = null;

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    private $createdBy = 0;

    /**
     * Publish.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $publish = null;

    /**
     * Featured.
     *
     * @var bool
     * @since 1.0.0
     */
    private $featured = false;

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('NOW');
        $this->publish = new \DateTime('NOW');
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @param string $plain
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPlain(string $plain)
    {
        $this->plain = $plain;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPlain() : string
    {
        return $this->plain;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
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
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage() : string
    {
        return $this->language;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPublish() : \DateTime
    {
        return $this->publish;
    }

    /**
     * @param string $language
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLanguage(string $language)
    {
        if(!ISO639x1Enum::isValidValue($language)) {
            throw new InvalidEnumValue($language);
        }

        $this->language = $language;
    }

    /**
     * @param \DateTime $publish
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPublish(\DateTime $publish)
    {
        $this->publish = $publish;
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
     * @param int $id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreatedBy(int $id)
    {
        $this->createdBy = $id;
    }

    /**
     * @param \DateTime $createdAt
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
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setType(int $type)
    {
        if(!NewsType::isValidValue($type)) {
            throw new InvalidEnumValue($type);
        }

        $this->type = $type;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return void
     *
     * @throws
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setStatus(int $status)
    {
        if(!NewsStatus::isValidValue($status)) {
            throw new InvalidEnumValue($status);
        }

        $this->status = $status;
    }

    /**
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function isFeatured() : bool
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFeatured(bool $featured)
    {
        $this->featured = $featured;
    }

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
            'publish' => $this->publish,
            'createdAt' => $this->createdAt,
            'createdBy' => $this->createdBy,
        ];
    }

    public function __toString() 
    {
        return $this->jsonSerialize();
    }

    public function jsonSerialize() 
    {
        return json_encode($this->toArray());
    }
}
