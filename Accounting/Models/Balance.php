<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Accounting\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

/**
 * Balance class.
 *
 * @package    Modules\Accounting\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class Balance
{

    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Balance data.
     *
     * @var array
     * @since 1.0.0
     */
    private array $balance = [];

    /**
     * Balance name.
     *
     * @var string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Balance description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Get balance id
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
     * Set name
     *
     * @param string $name Balance name
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description Balance description
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }
}
