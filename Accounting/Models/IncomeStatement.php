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

/**
 * IncomeStatement class.
 *
 * @package    Modules\Accounting\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class IncomeStatement
{
    private $id = 0;

    private $date = null;

    private $incomeStatement = [];

    public function __construct()
    {
    }
}
