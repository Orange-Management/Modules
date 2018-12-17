<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Accounting\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

/**
 * BatchPosting class.
 *
 * @package    Modules\Accounting\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class BatchPosting implements \Countable
{

    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    private $creator = 0;

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $created = null;

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private $description = '';

    /**
     * Postings.
     *
     * @var PostingAbstract[]
     * @since 1.0.0
     */
    private $postings = [];

    /**
     * Constructor.
     *
     * @since  1.0.0
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
     * @since  1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get description.
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param string $desc Description
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setDescription(string $desc) : void
    {
        $this->description = $desc;
    }

    /**
     * Get created.
     *
     * @return \DateTime
     *
     * @since  1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->created;
    }

    /**
     * Get creator.
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set creator.
     *
     * @param int $creator Creator ID
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setCreator($creator) : void
    {
        $this->creator = $creator;
    }

    /**
     * Get posting.
     *
     * @param int $id Posting ID
     *
     * @return null|PostingAbstract
     *
     * @since  1.0.0
     */
    public function getPosting(int $id) : ?PostingAbstract
    {
        return $this->postings[$id] ?? null;
    }

    /**
     * Remove posting.
     *
     * @param int $id Posting ID
     *
     * @return bool
     *
     * @since  1.0.0
     */
    public function removePosting($id) : bool
    {
        if (!isset($this->postings[$id])) {
            return false;
        }

        unset($this->postings[$id]);

        return true;
    }

    /**
     * Add posting.
     *
     * @param PostingAbstract $posting Posting
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function addPosting(PostingAbstract $posting) : void
    {
        $this->postings[] = $posting;
    }

    /**
     * {@inheritdoc}
     */
    public function count() : int
    {
        return count($this->postings);
    }
}
