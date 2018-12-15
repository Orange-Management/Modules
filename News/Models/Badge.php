<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\News\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\News\Models;

/**
 * News article class.
 *
 * @package    Modules\News\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Badge implements \JsonSerializable
{
    /**
     * Id.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Badge name
     *
     * @var string
     * @since 1.0.0
     */
    private $name = '';

    /**
     * Get id.
     *
     * @return int Badge id
     *
     * @since  1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set badge name.
     *
     * @param int Badge name
     *
     * @return void;
     *
     * @since  1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * Get name.
     *
     * @return string Badge name
     *
     * @since  1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
