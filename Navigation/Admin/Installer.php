<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Navigation\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Navigation\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\DataStorage\Database\DatabaseType;
use phpOMS\DataStorage\Database\RelationType;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;
use Modules\Navigation\Models\NavElement;
use Modules\Navigation\Models\NavElementMapper;

/**
 * Installer class.
 *
 * @package    Modules\Navigation\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Installer extends InstallerAbstract
{

    /**
     * Install data from providing modules.
     *
     * @param DatabasePool $dbPool Database pool
     * @param array        $data   Module info
     *
     * @return void
     *
     * @since  1.0.0
     */
    public static function installExternal(DatabasePool $dbPool, array $data) : void
    {
        try {
            $dbPool->get()->con->query('select 1 from `' . $dbPool->get()->prefix . 'nav`');
        } catch (\Exception $e) {
            return;
        }

        foreach ($data as $link) {
            self::installLink($dbPool, $link);
        }
    }

    /**
     * Install navigation element.
     *
     * @param DatabasePool $dbPool Database instance
     * @param array        $data   Link info
     *
     * @return void
     *
     * @since  1.0.0
     */
    private static function installLink($dbPool, $data) : void
    {
        $navElement = new NavElement();

        $navElement->id                = (int) ($data['id'] ?? 0);
        $navElement->pid               = (string) (\sha1(\str_replace('/', '', $data['pid'] ?? '')));
        $navElement->name              = (string) ($data['name'] ?? '');
        $navElement->type              = (int) ($data['type'] ?? 1);
        $navElement->subtype           = (int) ($data['subtype'] ?? 2);
        $navElement->icon              = $data['icon'] ?? null;
        $navElement->uri               = $data['uri'] ?? null;
        $navElement->target            = (string) ($data['target'] ?? 'self');
        $navElement->from              = (string) ($data['from'] ?? '0');
        $navElement->order             = (int) ($data['order'] ?? 1);
        $navElement->parent            = (int) ($data['parent'] ?? 0);
        $navElement->permissionPerm    = $data['permission']['permission'] ?? null;
        $navElement->permissionType    = $data['permission']['type'] ?? null;
        $navElement->permissionElement = $data['permission']['element'] ?? null;

        $lastInsertID = NavElementMapper::create($navElement, RelationType::ALL, true);

        foreach ($data['children'] as $link) {
            $parent = ($link['parent'] === null ? $lastInsertID : $link['parent']);
            self::installLink($dbPool, $link);
        }
    }
}
