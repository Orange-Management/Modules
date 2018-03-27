<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Admin\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Admin\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\UpdaterAbstract;
use phpOMS\Module\InfoManager;
use phpOMS\System\File\Directory;

/**
 * Update class.
 *
 * @package    Modules\Admin\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Updater extends UpdaterAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function update(DatabasePool $dbPool, InfoManager $info)
    {
        Directory::deletePath(__DIR__ . '/Update');
        mkdir('Update');
        parent::update($dbPool, $info);
    }
}
