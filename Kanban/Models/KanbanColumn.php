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
namespace Modules\Column\Models;


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
class KanbanColumn implements \JsonSerializable
{
    private $id = 0;

    private $name = '';

    private $order = 0;

    private $board = 0;

    private $cards = [];

    public function __construct()
    {
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) /* : void */
    {
        $this->name = $name;
    }

    public function getCards() : array
    {
        return $this->cards;
    }

    public function addCard(KanbanCard $card) /* : void */
    {
        $this->cards[] = $card;
    }

    public function removeCard(int $id) : bool
    {
        if(isset($this->cards[$id])) {
            unset($this->cards[$id]);

            return true;
        }

        return false;
    }

    public function jsonSerealize() : array
    {
        return [];
    }
}