<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Accounting\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

use phpOMS\Utils\IO\ExchangeInterface;

/**
 * Balance class.
 *
 * @package    Modules\Accounting\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class Balance
{

    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Balance data.
     *
     * @var array
     * @since 1.0.0
     */
    private $balance = [];

    /**
     * Constructor.
     *
     * @since  1.0.0
     */
    public function __construct()
    {
    }

    /**
     * @return int
     *
     * @since  1.0.0
     */
    public function getId()
    {
        return $this->id;
    }
}
