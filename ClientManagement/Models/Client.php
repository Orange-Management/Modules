<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\ClientManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ClientManagement\Models;

use Modules\Media\Models\Media;
use Modules\Profile\Models\Profile;

/**
 * Account class.
 *
 * @package Modules\ClientManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Client
{
    private int $id = 0;

    private string $number = '';

    private string $numberReverse = '';

    private int $status = 0;

    private int $type = 0;

    private array $ids = [];

    private string $info = '';

    private \DateTime $createdAt;

    private $profile = null;

    private array $files = [];

    private array $contactElements = [];

    private array $address = [];

    private array $partners = [];

    private $salesRep = null;

    private int $advertisementMaterial = 0;

    private $defaultDeliveryAddress = null;
    private $defaultInvoiceAddress = null;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->profile   = new Profile();
    }

    /**
     * Get id.
     *
     * @return int Model id
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    public function getNumber() : string
    {
        return $this->number;
    }

    public function setNumber(string $number) : void
    {
        $this->number = $number;
    }

    public function getReverseNumber()
    {
        return $this->numberReverse;
    }

    public function setReverseNumber($rev_no) : void
    {
        if (!\is_scalar($rev_no)) {
            throw new \Exception();
        }

        $this->numberReverse = $rev_no;
    }

    public function getStatus() : int
    {
        return $this->status;
    }

    public function setStatus(int $status) : void
    {
        $this->status = $status;
    }

    public function getType() : int
    {
        return $this->type;
    }

    public function setType(int $type) : void
    {
        $this->type = $type;
    }

    public function getTaxId() : int
    {
        return $this->taxId;
    }

    public function setTaxId(int $taxId) : void
    {
        $this->taxId = $taxId;
    }

    public function setDefaultDeliveryAddress($deliveryAddress) : void
    {
        $this->defaultDeliveryAddress = $deliveryAddress;
    }

    public function getDefaultDeliveryAddress()
    {
        return $this->defaultDeliveryAddress;
    }

    public function setDefaultInvoiceAddress($invoiceAddress) : void
    {
        $this->defaultTnvoiceAddress = $invoiceAddress;
    }

    public function getDefaultInvoiceAddress()
    {
        return $this->defaultInvoiceAddress;
    }

    public function getInfo() : string
    {
        return $this->info;
    }

    public function setInfo(string $info) : void  /* : void */
    {
        $this->info = $info;
    }

    /**
     * Get created at date time
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    public function getProfile() : Profile
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile) : void
    {
        $this->profile = $profile;
    }

    public function getFiles() : array
    {
        return $this->files;
    }

    public function addFile(Media $file) : void
    {
        $this->files[] = $file;
    }

    public function getAddresses() : array
    {
        return $this->address;
    }

    public function getContactElements() : array
    {
        return $this->contactElements;
    }
}
