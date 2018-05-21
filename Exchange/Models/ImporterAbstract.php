<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Interfaces
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Interfaces;

use phpOMS\DataStorage\Database\Connection\ConnectionInterface;

/**
 * Import abstract
 *
 * @package    Interfaces
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
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
     * Database connection.
     *
     * @var ConnectionInterface
     * @since 1.0.0
     */
    private $remote = null;

    /**
     * Constructor
     *
     * @param ConnectionInterface $local  Database connection
     * @param ConnectionInterface $remote Database connection
     *
     * @since  1.0.0
     */
    public function __construct(ConnectionInterface $local, ConnectionInterface $remote)
    {
        $this->remote = $remote;
        $this->local  = $local;
    }
}
