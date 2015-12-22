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


use phpOMS\Localization\ISO639Enum;

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
class NewsArticle
{

    /**
     * Article ID.
     *
     * @var \int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Author ID.
     *
     * @var \int
     * @since 1.0.0
     */
    private $author = 0;

    /**
     * Title.
     *
     * @var \string
     * @since 1.0.0
     */
    private $title = '';

    /**
     * Content.
     *
     * @var \string
     * @since 1.0.0
     */
    private $content = '';

    /**
     * Plain.
     *
     * @var \string
     * @since 1.0.0
     */
    private $plain = '';

    /**
     * News type.
     *
     * @var \int
     * @since 1.0.0
     */
    private $type = NewsType::ARTICLE;

    /**
     * News status.
     *
     * @var \int
     * @since 1.0.0
     */
    private $status = NewsStatus::VISIBLE;

    /**
     * Language.
     *
     * @var \string
     * @since 1.0.0
     */
    private $lang = ISO639Enum::_EN;

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $created = null;

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
     * @var \bool
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
        $this->created = new \DateTime('NOW');
        $this->publish = new \DateTime('NOW');
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAuthor() : \int
    {
        return $this->author;
    }

    /**
     * @return \string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getContent() : \string
    {
        return $this->content;
    }

    /**
     * @param \string $content
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setContent(\string $content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreated() : \DateTime
    {
        return $this->created;
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId() : \int
    {
        return $this->id;
    }

    /**
     * @param \int $id Id
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setId(\int $id)
    {
        $this->id = $id;
    }

    /**
     * @return \string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage() : \string
    {
        return $this->lang;
    }

    /**
     * @return \string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPlain() : \string
    {
        return $this->plain;
    }

    /**
     * @param \string $plain
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPlain(\string $plain)
    {
        $this->plain = $plain;
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
     * @param \string $lang
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLang(\string $lang)
    {
        $this->lang = $lang;
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
     * @param \DateTime $created
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @param \int $author
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAuthor(\int $author)
    {
        $this->author = $author;
    }

    /**
     * @return \string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTitle() : \string
    {
        return $this->title;
    }

    /**
     * @param \string $title
     *
     * @return mixed
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTitle(\string $title)
    {
        $this->title = $title;
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getType() : \int
    {
        return $this->type;
    }

    /**
     * @param \int $type
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setType(\int $type)
    {
        $this->type = $type;
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatus() : \int
    {
        return $this->status;
    }

    /**
     * @param \int $status
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setStatus(\int $status)
    {
        $this->status = $status;
    }

    /**
     * @return \bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function isFeatured() : \bool
    {
        return $this->featured;
    }

    /**
     * @param \bool $featured
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFeatured(\bool $featured)
    {
        $this->featured = $featured;
    }
}
