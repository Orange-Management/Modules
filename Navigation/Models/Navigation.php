<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Navigation\Models;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Message\RequestAbstract;
use phpOMS\Account\Account;
use phpOMS\Account\PermissionType;

/**
 * Navigation class.
 *
 * @package    Modules
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Navigation
{

    /**
     * Navigation array.
     *
     * Array of all navigation elements sorted by type->parent->id
     *
     * @var array
     * @since 1.0.0
     */
    private $nav = [];

    /**
     * Singleton instance.
     *
     * @var \Modules\Navigation\Models\Navigation
     * @since 1.0.0
     */
    private static $instance = null;

    /**
     * Database pool.
     *
     * @var DatabasePool
     * @since 1.0.0
     */
    private $dbPool = null;

    /**
     * Constructor.
     *
     * @param RequestAbstract $request Request hashes
     * @param Account         $account Account
     * @param DatabasePool    $dbPool  Database pool
     *
     * @since  1.0.0
     */
    private function __construct(RequestAbstract $request, Account $account, DatabasePool $dbPool)
    {
        $this->dbPool = $dbPool;
        $this->load($request->getHash(), $account);
    }

    /**
     * Load navigation based on request.
     *
     * @param string[] $hashes  Request hashes
     * @param Account  $account Account
     *
     * @return void
     *
     * @since  1.0.0
     */
    private function load(array $hashes, Account $account)
    {
        if (empty($this->nav)) {
            $this->nav = [];
            $uriPdo    = '';

            $i = 1;
            foreach ($hashes as $hash) {
                $uriPdo .= ':pid' . $i . ',';
                $i++;
            }

            $uriPdo = rtrim($uriPdo, ',');
            $sth    = $this->dbPool->get('select')->con->prepare('SELECT * FROM `' . $this->dbPool->get('select')->prefix . 'nav` WHERE `nav_pid` IN(' . $uriPdo . ') ORDER BY `nav_order` ASC');

            $i = 1;
            foreach ($hashes as $hash) {
                $sth->bindValue(':pid' . $i, $hash, \PDO::PARAM_STR);
                $i++;
            }

            $sth->execute();
            $tempNav = $sth->fetchAll(\PDO::FETCH_GROUP);

            foreach ($tempNav as $id => $link) {
                $isReadable = $account->hasPermission(
                    PermissionType::READ,
                    null,
                    null,
                    (string) $link[0]['nav_from'],
                    (int) $link[0]['nav_permission_type'],
                    (int) $link[0]['nav_permission_element']
                );

                if ($isReadable) {
                    $tempNav[$id][0]['readable'] = true;

                    $this->setReadable($tempNav, $tempNav[$id][0]['nav_parent']);
                }
            }

            foreach ($tempNav as $id => $link) {
                if (isset($link[0]['readable']) && $link[0]['readable']) {
                    $this->nav[$link[0]['nav_type']][$link[0]['nav_subtype']][$id] = $link[0];
                }
            }
        }
    }

    /**
     * Set navigation elements as readable
     *
     * @param array $nav    Full Navigation
     * @param int   $parent Parent id
     *
     * @return void
     *
     * @since  1.0.0
     */
    private function setReadable(array &$nav, int $parent) : void
    {
        if (isset($nav[$parent])) {
            $nav[$parent][0]['readable'] = true;

            if (isset($nav[$nav[$parent][0]['nav_parent']])
                && (!isset($nav[$nav[$parent][0]['nav_parent']][0]['readable'])
                    || !$nav[$nav[$parent][0]['nav_parent']][0]['readable'])
            ) {
                $this->setReadable($nav, $nav[$parent][0]['nav_parent']);
            }
        }
    }

    /**
     * Get instance.
     *
     * @param RequestAbstract $hashes  Request hashes
     * @param Account         $account Account
     * @param DatabasePool    $dbPool  Database pool
     *
     * @return \Modules\Navigation\Models\Navigation
     *
     * @throws \Exception
     *
     * @since  1.0.0
     */
    public static function getInstance(RequestAbstract $hashes = null, Account $account, DatabasePool $dbPool)
    {
        if (!isset(self::$instance)) {
            if (!isset($hashes) || !isset($dbPool)) {
                throw new \Exception('Invalid parameters');
            }

            self::$instance = new self($hashes, $account, $dbPool);
        }

        return self::$instance;
    }

    /**
     * Get navigation based on account permissions
     *
     * @return array
     *
     * @since  1.0.0
     */
    public function getNav() : array
    {
        return $this->nav;
    }
}
