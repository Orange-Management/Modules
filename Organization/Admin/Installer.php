<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Organization\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Organization\Admin;

use Modules\Organization\Models\Unit;
use Modules\Organization\Models\UnitMapper;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\Module\InfoManager;
use phpOMS\Module\InstallerAbstract;

/**
 * Installer class.
 *
 * @package    Modules\Organization\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Installer extends InstallerAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function install(DatabasePool $dbPool, InfoManager $info) : void
    {
        parent::install($dbPool, $info);

        $unit = new Unit();
        $unit->setName('Orange Management');

        UnitMapper::create($unit);
    }
}
