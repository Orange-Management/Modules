<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\QA\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\QA\Models;

/**
 * Task class.
 *
 * @package    Modules\QA\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class QACategory implements \JsonSerializable
{
    private $id = 0;

    private $name = '';

    private $parent = null;

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

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getParent() : ?int
    {
        return $this->parent;
    }

    public function setParent(int $parent) : void
    {
        $this->parent = $parent;
    }

    public function jsonSerialize() : array
    {
        return [];
    }
}
