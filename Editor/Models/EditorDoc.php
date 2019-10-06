<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Editor\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Editor\Models;

use phpOMS\Contract\ArrayableInterface;

/**
 * News article class.
 *
 * @package Modules\Editor\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class EditorDoc implements ArrayableInterface, \JsonSerializable
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
     * Doc path for organizing.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $path = '';

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
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('NOW');
    }

    /**
     * @return string
     *
     * @since 1.0.0
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
     * @since 1.0.0
     */
    public function setContent(string $content) : void
    {
        $this->content = $content;
    }

    /**
     * @param string $plain
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
     * @return string
     *
     * @since 1.0.0
     */
    public function getPlain() : string
    {
        return $this->plain;
    }

    /**
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param int $id
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
     * @param string $title
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function setPath(string $path)
    {
        $this->path = $path;
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
