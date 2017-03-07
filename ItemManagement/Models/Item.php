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
namespace Modules\ItemManagement\Models;

/**
 * Account class.
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Item
{
    private $id = 0;

    private $number = 0;

    private $articleGroup = 0;

    private $salesGroup = 0;

    private $productGroup = 0;

    private $segment = 0;

    private $successor = 0;

    public function __construct(int $id = 0)
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getNumber() : int
    {
        return $this->number;
    }

    public function getArticleGroup() : int
    {
        return $this->articleGroup;
    }

    public function getSalesGroup() : int
    {
        return $this->salesGroup;
    }

    public function getProductGroup() : int
    {
        return $this->productGroup;
    }

    public function getSegment() : int
    {
        return $this->segment;
    }

    public function getSuccessor() : int
    {
        return $this->successor;
    }
}
