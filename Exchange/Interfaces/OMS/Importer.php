<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Interfaces
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */

declare(strict_types=1);

namespace Modules\Exchange\Interfaces\OMS;

use Modules\Accounting\Models\CostCenter;
use Modules\Accounting\Models\CostCenterMapper;
use Modules\Accounting\Models\CostObject;
use Modules\Accounting\Models\CostObjectMapper;
use Modules\Exchange\Interfaces\OMS\Model\ExchangeType;
use Modules\Exchange\Models\ImporterAbstract;

use phpOMS\Message\RequestAbstract;
use Modules\ClientManagement\Models\ClientMapper;

/**
 * OMS import class
 *
 * @package Modules\Exchange\Models\Interfaces\OMS
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class Importer extends ImporterAbstract
{
    /**
     * Import data from request
     *
     * @param RequestAbstract $request Request
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function importFromRequest(RequestAbstract $request): bool
    {
        $start = new \DateTime($request->getData('start') ?? 'now');
        $end   = new \DateTime($request->getData('end') ?? 'now');

        $type   = (int) ($request->getData('type') ?? 0);
        $source = (int) ($request->getData('source') ?? 0);

        if ($type === ExchangeType::CUSTOMER) {
            $this->importCustomer($start, $end);
        } elseif ($type === ExchangeType::SUPPLIER) {
            $this->importSupplier($start, $end);
        } elseif ($type === ExchangeType::ACCOUNT) {
            $this->importAccount($start, $end);
        } elseif ($type === ExchangeType::COSTCENTER) {
            $this->importCostCenter($start, $end);
        } elseif ($type === ExchangeType::COSTOBJECT) {
            $this->importCostObject($start, $end);
        } elseif ($type === ExchangeType::ARTICLE) {
            $this->importArticle($start, $end);
        } elseif ($type === ExchangeType::INVOICE) {
            $this->importInvoice($start, $end);
        }

        return true;
    }

    /**
     * Import cost centers
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function importCostCenter(\DateTime $start, \DateTime $end): void
    {
        $costCenters = OMSCostCenterMapper::getAll();

        $obj = new CostCenter();
        DataMapperAbstract::setConnection($this->local);

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
     * @since 1.0.0
     */
    public function importCostObject(\DateTime $start, \DateTime $end): void
    {
        $costObjects = OMSCostObjectMapper::getAll();

        $obj = new CostObject();
        DataMapperAbstract::setConnection($this->local);

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
     * @since 1.0.0
     */
    public function importAddress(\DateTime $start, \DateTime $end): void
    {
        while (($line = \fgetcsv($this->remote)) !== false) {
            var_dump($line);
        }
    }

    /**
     * Import customers
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function importCustomer(\DateTime $start, \DateTime $end): void
    {
        $euTIN  = CustomerIdTypeMapper::getByType(CustomerIdType::EU_TIN);
        $gerTIN = CustomerIdTypeMapper::getByType(CustomerIdType::GER_TIN);

        while (($line = \fgetcsv($this->remote)) !== false) {
            $customer = new Client();

            $customer->setNumber($line[0]);
            $customer->getProfile()->getAccount()->setName1($line[1]);
            $customer->getProfile()->getAccount()->setName2($line[2]);
            $customer->getProfile()->getAccount()->setName3($line[3]);
            //$customer->addEmail(EmailType::BUSINESS, $line[4]);
            //$customer->addPhone(PhoneType::BUSINESS, $line[5]);
            //$customer->addWebsite(PhoneType::BUSINESS, $line[5]);

            $address = new Address();
            $customer->setDefaultDeliveryAddress($address);
            $customer->setDefaultInvoiceAddress($address);

            $customer->setDefaultPaymentTerms(new PaymentTerms());
            $customer->setCreditLimit($line[12]);
            $customer->setStatus($line[9]);
            $customer->setInfo($line[9]);
            $customer->setAdvertisementMaterial($line[13]);
            $customer->setSalesRep();
            $customer->setType();
            $customer->addPartner();

            $customer->addId($euTIN, $line[10]);
            $customer->addId($gerTIN, $line[11]);

            ClientMapper::create($customer);
        }
    }

    /**
     * Import suppliers
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function importSupplier(\DateTime $start, \DateTime $end): void
    { }

    /**
     * Import accounts
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function importAccount(\DateTime $start, \DateTime $end): void
    { }

    /**
     * Import invoices
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function importInvoice(\DateTime $start, \DateTime $end): void
    { }

    /**
     * Import postings
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function importPosting(\DateTime $start, \DateTime $end): void
    { }

    /**
     * Import batch postings
     *
     * @param \DateTime $start Start time (inclusive)
     * @param \DateTime $end   End time (inclusive)
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function importBatchPosting(\DateTime $start, \DateTime $end): void
    { }
}
