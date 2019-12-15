<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Helper\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Helper\Models;

/**
 * Template model.
 *
 * @package Modules\Helper\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Template implements \JsonSerializable
{
    /**
     * Template Id.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Template status.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $status = HelperStatus::INACTIVE;

    /**
     * Template data type.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $datatype = TemplateDataType::OTHER;

    /**
     * Template doesn't need reports.
     *
     * @var   bool
     * @since 1.0.0
     */
    private bool $isStandalone = false;

    /**
     * Template name.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Template description.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Template description.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $descriptionRaw = '';

    /**
     * Template created at.
     *
     * @var   \DateTime
     * @since 1.0.0
     */
    protected \DateTime $createdAt;

    /**
     * Template created by.
     *
     * @var   int
     * @since 1.0.0
     */
    private $createdBy = 0;

    /**
     * Template source.
     *
     * @var   int|Media
     * @since 1.0.0
     */
    private $source = 0;

    /**
     * Expected files.
     *
     * @var   array
     * @since 1.0.0
     */
    private array $expected = [];

    /**
     * Reports.
     *
     * @var   array
     * @since 1.0.0
     */
    private array $reports = [];

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get newest report for template.
     *
     * @return Report
     *
     * @since 1.0.0
     */
    public function getNewestReport() : Report
    {
        if (!empty($this->reports)) {
            return \end($this->reports);
        }

        return new NullReport();
    }

    /**
     * @param string $name Template name
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $description Template description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $description Template description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescriptionRaw(string $description) : void
    {
        $this->descriptionRaw = $description;
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * @param int $source Source
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $createdBy Creator
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy($createdBy) : void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return int|\phpOMS\Account\Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt ?? new \DateTime('now');
    }

    /**
     * @param array $expected Expected files
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setExpected(array $expected) : void
    {
        $this->expected = $expected;
    }

    /**
     * @return array
     *
     * @since 1.0.0
     */
    public function getExpected() : array
    {
        return $this->expected;
    }

    /**
     * @param string $expected Expected file
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addExpected(string $expected) : void
    {
        $this->expected[] = $expected;
    }

    /**
     * @param int $status Template status (is active?)
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setStatus(int $status) : void
    {
        $this->status = $status;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @param int $datatype Template datatype source
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDatatype(int $datatype) : void
    {
        $this->datatype = $datatype;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getDatatype() : int
    {
        return $this->datatype;
    }

    /**
     * @param bool $isStandalone Is template standalone
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setStandalone(bool $isStandalone) : void
    {
        $this->isStandalone = $isStandalone;
    }

    /**
     * @return bool
     *
     * @since 1.0.0
     */
    public function isStandalone() : bool
    {
        return $this->isStandalone;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'          => $this->id,
            'createdBy'   => $this->createdBy,
            'createdAt'   => $this->createdAt->format('Y-m-d H:i:s'),
            'name'        => $this->name,
            'description' => $this->description,
            'status'      => $this->status,
            'datatype'    => $this->datatype,
            'standalone'  => $this->isStandalone,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
