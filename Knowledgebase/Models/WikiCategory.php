<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Knowledgebase\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Knowledgebase\Models;

/**
 * Task class.
 *
 * @package    Modules\Knowledgebase\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class WikiCategory implements \JsonSerializable
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

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : array
    {
        return [];
    }
}
