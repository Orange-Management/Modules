<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\ItemManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ItemManagement\Models;

use Modules\Media\Models\Media;

/**
 * Account class.
 *
 * @package Modules\ItemManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Item
{
    private $id = 0;

    private $number = '';

    private $articleGroup = 0;

    private $salesGroup = 0;

    private $productGroup = 0;

    private $segment = 0;

    private $successor = 0;

    private $type = 0;

    private $media = [];

    private $l11n = null;

    private $attributes = [];

    private $partslist = null;

    private $purchase = [];

    private $disposal = null;

    private $createdAt = null;

    private string $name1 = '';

    private string $name2 = '';

    private string $name3 = '';

    private string $name4 = '';

    private string $name5 = '';

    private $info = '';

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    public function setSuccessor(int $successor): void
    {
        $this->successor = $successor;
    }

    public function getSuccessor(): int
    {
        return $this->successor;
    }

    public function getNumber() : string
    {
        return $this->number;
    }

    public function setNumber(string $number) : void
    {
        $this->number = $number;
    }

    public function setName1(string $name) : void
    {
        $this->name1 = $name;
    }

    public function getName1() : string
    {
        return $this->name1;
    }

    public function setName2(string $name) : void
    {
        $this->name2 = $name;
    }

    public function getName2() : string
    {
        return $this->name2;
    }

    public function setName3(string $name) : void
    {
        $this->name3 = $name;
    }

    public function getName3() : string
    {
        return $this->name3;
    }

    public function setName4(string $name): void
    {
        $this->name4 = $name;
    }

    public function getName4(): string
    {
        return $this->name4;
    }

    public function setName5(string $name): void
    {
        $this->name5 = $name;
    }

    public function getName5(): string
    {
        return $this->name5;
    }
}
