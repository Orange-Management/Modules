<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Kanban\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Kanban\Models;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use Modules\Tasks\Models\Task;

/**
 * Kanban card class.
 *
 * @package Modules\Kanban\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class KanbanCard implements \JsonSerializable
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    private string $name = '';

    private int $status = CardStatus::ACTIVE;

    private int $type = CardType::TEXT;
    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';

    private $column = 0;

    private $order = 0;

    private $ref = 0;

    private Account $createdBy;

    private \DateTime $createdAt;

    private array $comments = [];

    private array $labels = [];

    private array $media = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->createdBy = new NullAccount();
    }

    /**
     * Get the order
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getOrder() : int
    {
        return $this->order;
    }

    /**
     * Set the order
     *
     * @param int $order Order
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setOrder(int $order) : void
    {
        $this->order = $order;
    }

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
     * Set the column
     *
     * @param int $id Id
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setColumn(int $id) : void
    {
        $this->column = $id;
    }

    /**
     * Get the column
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getColumn() : int
    {
        return $this->column;
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
     * Get the status
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
     * Set the status
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
     * Get the card type
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
     * Set the card type
     *
     * @param int $type Card type
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setType(int $type) : void
    {
        $this->type = $type;
    }

    /**
     * Get the reference if the card references another object (e.g. task, calendar etc.)
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getRef() : int
    {
        return $this->ref;
    }

    /**
     * Set the reference
     *
     * @param int $ref Reference
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setRef(int $ref) : void
    {
        $this->ref = $ref;
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
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
     * @param Account $account Created by
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy(Account $account) : void
    {
        $this->createdBy = $account;
    }

    /**
     * Get created at date time
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
     * Get the comments
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getComments() : array
    {
        return $this->comments;
    }

    /**
     * Add a comment
     *
     * @param mixed $comment Comment
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addComment($comment) : void
    {
        $this->comments[] = $comment;
    }

    /**
     * Remove a comment
     *
     * @param int $id Comment id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeComment(int $id) : bool
    {
        if (isset($this->comments[$id])) {
            unset($this->comments[$id]);

            return true;
        }

        return false;
    }

    /**
     * Get the media files
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getMedia() : array
    {
        return $this->media;
    }

    /**
     * Add a media file
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addMedia($media) : void
    {
        $this->media[] = $media;
    }

    /**
     * Set labels of the card
     *
     * @param array $labels Labels
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setLabels(array $labels) : void
    {
        $this->labels = $labels;
    }

    /**
     * Get the labels
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getLabels() : array
    {
        return $this->labels;
    }

    /**
     * Add a label/tag
     *
     * @param mixed $label Label
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addLabel($label) : void
    {
        $this->labels[] = $label;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : array
    {
        return [
            'title' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'type' => $this->type,
            'column' => $this->name,
            'order' => $this->name,
            'ref' => $this->name,
            'createdBy' => $this->name,
            'createdAt' => $this->name,
            'labels' => $this->name,
            'comments' => $this->name,
            'media' => $this->name,
        ];
    }

    /**
     * Create a task from a card
     *
     * @param Task $task Task to create the card from
     *
     * @return KanbanCard
     *
     * @since 1.0.0
     */
    public static function createFromTask(Task $task) : self
    {
        $card = new self();
        $card->setRef($task->getId());

        return $card;
    }
}
