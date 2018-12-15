<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Draw\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Draw\Models;

use Modules\Media\Models\Media;
use phpOMS\Contract\ArrayableInterface;

/**
 * News article class.
 *
 * @package    Modules\Draw\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class DrawImage implements ArrayableInterface, \JsonSerializable
{

    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Media object.
     *
     * @var Media
     * @since 1.0.0
     */
    private $media = null;

    /**
     * Get id
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
     * Get media
     *
     * @return int|Media
     *
     * @since  1.0.0
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set media
     *
     * @param int|Media $media
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setMedia($media) : void
    {
        $this->media = $media;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'media' => $this->media->toArray(),
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

    /**
     * Create Image from media
     *
     * @param Media $media Media object
     *
     * @return void
     *
     * @since  1.0.0
     */
    public static function fromMedia(Media $media) : self
    {
        $image = new self();
        $image->setMedia($media);

        return $image;
    }
}
