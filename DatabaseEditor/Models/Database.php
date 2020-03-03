<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\DatabaseEditor\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\DatabaseEditor\Models;

/**
 * Database.
 *
 * @package Modules\DatabaseEditor\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Database
{
    /**
     * Name of the database
     *
     * @var string
     * @since 1.0.0
     */
    public $name = '';

    /**
     * Tables
     *
     * @var string[]
     * @since 1.0.0
     */
    public $tables = [];
}
