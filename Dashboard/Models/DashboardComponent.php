<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Dashboard
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Dashboard\Models;

/**
 * DashboardBoard class.
 *
 * @package    Modules\Dashboard
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class DashboardComponent implements \JsonSerializable
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Order.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $order = 0;

    /**
     * Board.
     *
     * @var int|DashboardBoard
     * @since 1.0.0
     */
    protected $board = 0;

    /**
     * Module.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $module = '';

    /**
     * Component.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $component = '';

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
     * Get order
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getOrder() : int
    {
        return $this->order;
    }

    /**
     * Set order
     *
     * @param int $order Order
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setOrder(int $order) : void
    {
        $this->order = $order;
    }

    /**
     * Get component
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function getComponent() : string
    {
        return $this->component;
    }

    /**
     * Set component
     *
     * @param string $component Component
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setComponent(string $component) : void
    {
        $this->component = $component;
    }

    /**
     * Get module
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function getModule() : string
    {
        return $this->module;
    }

    /**
     * Set module
     *
     * @param string $module Module
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setModule(string $module) : void
    {
        $this->module = $module;
    }

    /**
     * Get board
     *
     * @return int|DashboardBoard
     *
     * @since  1.0.0
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * Set board
     *
     * @param mixed $id Board
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setBoard($id) : void
    {
        $this->board = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'        => $this->id,
            'board'     => $this->board,
            'order'     => $this->order,
            'module'    => $this->module,
            'component' => $this->component,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
