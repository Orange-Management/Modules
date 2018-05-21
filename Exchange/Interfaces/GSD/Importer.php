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

namespace Interfaces\GSD;

use Interfaces\ImporterAbstract;
use Interfaces\GSD\Model\GSDCostCenterMapper;
use Interfaces\GSD\Model\GSDCostObjectMapper;
use Interfaces\GSD\Model\GSDCustomerMapper;

use Modules\Accounting\Models\CostCenterMapper;
use Modules\Accounting\Models\CostCenter;
use Modules\Accounting\Models\CostObjectMapper;
use Modules\Accounting\Models\CostObject;

use Modules\ClientManagement\Models\ClientMapper;
use Modules\ClientManagement\Models\Client;

use phpOMS\DataStorage\Database\Query\Builder;

/**
 * GSD import class
 *
 * @package    Interfaces\GSD
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class Importer extends ImporterAbstract
{
    /**
     * Import all data in time span
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function import(\DateTime $start, \DateTime $end) : void
    {
        $this->importCostCenter($start, $end);
        $this->importCostObject($start, $end);
        $this->importAddress($start, $end);
        $this->importCustomer($start, $end);
        $this->importSupplier($start, $end);
        $this->importArticle($start, $end);
        $this->importAccount($start, $end);
        $this->importInvoice($start, $end);
        $this->importPosting($start, $end);
        $this->importBatchPosting($start, $end);
    }

    /**
     * Import cost centers
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function importCostCenter(\DateTime $start, \DateTime $end) : void
    {
        DataMapperAbstract::setConnection($this->app->dbPool->get('gsd'));
        $costCenters = GSDCostCenterMapper::getAll();

        $obj = new CostCenter();
        DataMapperAbstract::setConnection($this->app->dbPool->get('oms'));

        foreach ($costCenters as $cc) {
            $obj->setCostCenter((int) $cc->getCostCenter());
            $obj->setCostCenterName($cc->getDescription());

            CostCenterMapper::create($obj);
        }
    }

    /**
     * Import cost objects
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function importCostObject(\DateTime $start, \DateTime $end) : void
    {
        DataMapperAbstract::setConnection($this->app->dbPool->get('gsd'));
        $costObjects = GSDCostObjectMapper::getAll();

        $obj = new CostObject();
        DataMapperAbstract::setConnection($this->app->dbPool->get('oms'));

        foreach ($costObjects as $co) {
            $obj->setCostObject((int) $co->getCostObject());
            $obj->setCostObjectName($co->getDescription());

            CostObjectMapper::create($obj);
        }
    }

    /**
     * Import addresses
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function importAddress(\DateTime $start, \DateTime $end) : void
    {
    }

    /**
     * Import customers
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function importCustomer(\DateTime $start, \DateTime $end) : void
    {
    }

    /**
     * Import suppliers
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function importSupplier(\DateTime $start, \DateTime $end) : void
    {
    }

    /**
     * Import accounts
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function importAccount(\DateTime $start, \DateTime $end) : void
    {
    }

    /**
     * Import invoices
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function importInvoice(\DateTime $start, \DateTime $end) : void
    {
    }

    /**
     * Import postings
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function importPosting(\DateTime $start, \DateTime $end) : void
    {
    }

    /**
     * Import batch postings
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function importBatchPosting(\DateTime $start, \DateTime $end) : void
    {
    }
}
