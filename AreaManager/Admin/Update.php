<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\AreaManager\Admin;


use phpOMS\DataStorage\Database\Pool;
use phpOMS\Module\UpdateAbstract;
use phpOMS\System\FileSystem;

/**
 * Navigation class.
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Update extends UpdateAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function update(Pool $dbPool, array $info)
    {
        FileSystem::deletePath(__DIR__ . '/Update');
        mkdir('Update');
        parent::update($dbPool, $info);
    }
}