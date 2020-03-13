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

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
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
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    private string $title = '';

    /**
     * Content.
     *
     * @var string
     * @since 1.0.0
     */
    private string $content = '';

    /**
     * Unparsed.
     *
     * @var string
     * @since 1.0.0
     */
    private string $plain = '';

    /**
     * Doc path for organizing.
     *
     * @var string
     * @since 1.0.0
     */
    private string $path = '';

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private \DateTime $createdAt;

    /**
     * Creator.
     *
     * @var Account
     * @since 1.0.0
     */
    private Account $createdBy;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdBy = new NullAccount();
        $this->createdAt = new \DateTime('now');
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
     * Set the content
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
     * Set the plain text
     *
     * @param string $plain Plain text
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
     * Get the plain text
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
     * Get created at
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
     * Get the id
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
     * Get created by
     *
     * @return Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy() : Account
    {
        return $this->createdBy;
    }

    /**
     * Set created by
     *
     * @param Account $account Creator
     *
     * @since 1.0.0
     */
    public function setCreatedBy(Account $account) : void
    {
        $this->createdBy = $account;
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
     * @return mixed
     *
     * @since 1.0.0
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get the path
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * Set the path if file
     *
     * @param string $path Path to file
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
            'createdAt' => $this->createdAt,
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
