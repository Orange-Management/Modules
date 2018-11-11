<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\DatabaseEditor
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\DatabaseEditor\Models;

/**
 * Database
 *
 * @package    Modules\DatabaseEditor
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Database extends Enum
{
    public $name = '';

    public $tables = [];
}
