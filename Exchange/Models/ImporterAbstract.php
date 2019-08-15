<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Interfaces
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Exchange\Models;

use phpOMS\DataStorage\Database\Connection\ConnectionInterface;
use phpOMS\Message\RequestAbstract;

/**
 * Import abstract
 *
 * @package    Interfaces
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class ImporterAbstract
{
    /**
     * Database connection.
     *
     * @var ConnectionInterface
     * @since 1.0.0
     */
    private $local = null;

    /**
     * Constructor
     *
     * @param ConnectionInterface $local Database connection
     *
     * @since  1.0.0
     */
    public function __construct(ConnectionInterface $local)
    {
        $this->local = $local;
    }

    /**
     * Import data from request
     *
     * @param RequestAbstract $request Request
     *
     * @return bool
     *
     * @since  1.0.0
     */
    abstract public function importFromRequest(RequestAbstract $request) : bool;
}
