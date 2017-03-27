<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\Kanban\Models;

use Modules\Media\Models\Media;

/**
 * Task class.
 *
 * @category   Kanban
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class KanbanCard implements \JsonSerializable
{
    private $id = 0;

    private $name = '';

    private $status = CardStatus::ACTIVE;

    private $type = CardType::TEXT;

    private $description = '';

    private $column = 0;

    private $order = 0;

    private $ref = 0;

    private $createdBy = 0;

    private $createdAt = null;

    private $comments = [];

    private $labels = [];

    private $media = [];

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getOrder() : int
    {
        return $this->order;
    }

    public function setOrder(int $order) /* : void */
    {
        $this->order = $order;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setColumn(int $id) /* : void */
    {
        $this->column = $id;
    }

    public function getColumn() : int
    {
        return $this->column;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) /* : void */
    {
        $this->name = $name;
    }

    public function getStatus() : int
    {
        return $this->status;
    }

    public function setStatus(int $status) /* : void */
    {
        $this->status = $status;
    }

    public function getType() : int
    {
        return $this->type;
    }

    public function setType(int $type) /* : void */
    {
        $this->type = $type;
    }

    public function getRef() : int
    {
        return $this->ref;
    }

    public function setRef(int $ref) /* : void */
    {
        $this->ref = $ref;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) /* : void */
    {
        $this->description = $description;
    }

    public function getCreatedBy() : int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $id) /* : void */
    {
        $this->createdBy = $id;
    }

    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    public function getComments() : array
    {
        return $this->comments;
    }

    public function addComment($comment) /* : void */
    {
        $this->comments[] = $comment;
    }

    public function removeComment(int $id) : bool
    {
        if(isset($this->comment[$id])) {
            unset($this->comment[$id]);

            return true;
        }

        return false;
    }

    public function getMedia() : array
    {
        return $this->media;
    }

    public function addMedia($media) /* : void */
    {
        $this->media[] = $media;
    }

    public function getLabels() : array
    {
        return $this->labels;
    }

    public function addLabel($label) /* : void */
    {
        $this->labels[] = $label;
    }

    public function jsonSerialize() : array
    {
        return [];
    }

    /* todo: create function to create card from task etc... this fills the values here. what happens if task changes? bad idea! */
    /* todo: maybe allow ref to be an object and datamapper creates that object? how does the datamapper know what kind of datamapper to use? Just assume it's called ObjectMapper? bad isn't it?! */
}