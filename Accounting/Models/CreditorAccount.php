<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types = 1);
namespace Modules\Accounting\Models;

use Modules\Accounting\Models\PersonalAccountAbstract;

/**
 * Creditor account class.
 *
 * @package    Modules
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class CreditorAccount extends PersonalAccountAbstract
{

    /**
     * Constructor.
     *
     * @since  1.0.0
     */
    public function __construct()
    {
    }

    public function getPDO()
    {
    }

    public function getDefault()
    {
    }
}
