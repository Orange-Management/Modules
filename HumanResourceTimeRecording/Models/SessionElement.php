<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\HumanResourceTimeRecording
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\HumanResourceTimeRecording\Models;

/**
 * Null model
 *
 * @package    Modules\HumanResourceTimeRecording
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class SessionElement implements ArrayableInterface, \JsonSerializable
{
    private $id = 0;

    public function getId() : int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) \json_encode($this->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        eturn $this->toArray();
    }
}
