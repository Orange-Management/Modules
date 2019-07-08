<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Comments\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Comments\Models;

/**
 * Task class.
 *
 * @package    Modules\Comments\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class Comment
{
    private $id = 0;

    private $createdBy = 0;

    private $createdAt = null;

    private $list = null;

    private $title = '';

    private $status = 0;

    private $content = '';

    private $contentRaw = '';

    private $ref = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setRef($ref) : void
    {
        $this->ref = $ref;
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function setList($list) : void
    {
        $this->list = $list;
    }

    public function getList()
    {
        return $this->list;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function setContent(string $content) : void
    {
        $this->content = $content;
    }

    public function getContentRaw() : string
    {
        return $this->contentRaw;
    }

    public function setContentRaw(string $contentRaw) : void
    {
        $this->contentRaw = $contentRaw;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy) : void
    {
        $this->createdBy = $createdBy;
    }

    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }
}
