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

/**
 * Task class.
 *
 * @package Modules\Kanban\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class KanbanColumn implements \JsonSerializable
{
    /**
     * ID.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Name.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $name = '';

    private $order = 0;

    private $board = 0;

    private $cards = [];

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
     * Get the board this column belongs to
     *
     * @param int $board Board
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setBoard(int $board) : void
    {
        $this->board = $board;
    }

    /**
     * Get the board this column belongs to
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getBoard() : int
    {
        return $this->board;
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
     * Get the cards
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getCards() : array
    {
        return $this->cards;
    }

    /**
     * Add a card
     *
     * @param KanbanCard $card Card
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addCard(KanbanCard $card) : void
    {
        $this->cards[] = $card;
    }

    /**
     * Remove a card
     *
     * @param int $id Card to remove
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeCard(int $id) : bool
    {
        if (isset($this->cards[$id])) {
            unset($this->cards[$id]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : array
    {
        return [];
    }
}
