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

namespace Modules\RiskManagement\Admin;

use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\DataStorage\Database\Schema\Builder;
use phpOMS\Module\UninstallerAbstract;
use phpOMS\Module\InfoManager;

/**
 * Navigation class.
 *
 * @package    Modules
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Uninstaller extends UninstallerAbstract
{

    /**
     * {@inheritdoc}
     */
    public static function uninstall(DatabasePool $dbPool, InfoManager $info)
    {
        parent::uninstall($dbPool, $info);

        $query = new Builder($dbPool->get());

        $query->prefix($dbPool->get()->getPrefix())->drop(
            'riskmngmt_risk_solution',
            'riskmngmt_risk_cause',
            'riskmngmt_risk_media',
            'riskmngmt_risk_eval',
            'riskmngmt_risk_object',
            'riskmngmt_risk',
            'riskmngmt_process',
            'riskmngmt_project',
            'riskmngmt_category',
            'riskmngmt_department',
            'riskmngmt_unit'
        );

        $dbPool->get()->con->prepare($query->toSql())->execute();
    }
}
