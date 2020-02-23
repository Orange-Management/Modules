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
     * @var int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Unit.
     *
     * @var null|int|\Modules\Organization\Models\Unit
     * @since 1.0.0
     */
    private $unit = null;

    /**
     * Template status.
     *
     * @var int
     * @since 1.0.0
     */
    private int $status = HelperStatus::INACTIVE;

    /**
     * Template data type.
     *
     * @var int
     * @since 1.0.0
     */
    private int $datatype = TemplateDataType::OTHER;

    /**
     * Template doesn't need reports.
     *
     * @var bool
     * @since 1.0.0
     */
    private bool $isStandalone = false;

    /**
     * Template name.
     *
     * @var string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Template description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Template description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $descriptionRaw = '';

    /**
     * Template created at.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected \DateTime $createdAt;

    /**
     * Template created by.
     *
     * @var int|\Modules\Admin\Models\Account
     * @since 1.0.0
     */
    private $createdBy = 0;

    /**
     * Template source.
     *
     * @var int|\Modules\Media\Models\Media
     * @since 1.0.0
     */
    private $source = 0;

    /**
     * Expected files.
     *
     * @var array
     * @since 1.0.0
     */
    private array $expected = [];

    /**
     * Reports.
     *
     * @var array
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
     * Get model id
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get unit this template belogns to
     *
     * @return null|int|\Modules\Organization\Models\Unit
     *
     * @since 1.0.0
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set unit this model belongs to
     *
     * Set the unit
     *
     * @param int $unit Unit
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setUnit(int $unit) : void
    {
        $this->unit = $unit;
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
     * Set template name
     *
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
     * Get template name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set description
     *
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
     * Get description
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set raw description
     *
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
     * Get raw description
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * Set source media
     *
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
     * Get source media
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set creator
     *
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
     * Get creator
     *
     * @return int|\phpOMS\Account\Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Get created date
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt ?? new \DateTime('now');
    }

    /**
     * Set expected files from reports
     *
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
     * Get expected files from report
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getExpected() : array
    {
        return $this->expected;
    }

    /**
     * Add expected file from report
     *
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
     * Set activity satuus
     *
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
     * Get activity status
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * Set data type basis
     *
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
     * Get data type basis
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getDatatype() : int
    {
        return $this->datatype;
    }

    /**
     * Set if the template needs report data
     *
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
     * Does the template need report data?
     *
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
            'id'             => $this->id,
            'createdBy'      => $this->createdBy,
            'createdAt'      => $this->createdAt,
            'name'           => $this->name,
            'description'    => $this->description,
            'descriptionRaw' => $this->descriptionRaw,
            'status'         => $this->status,
            'datatype'       => $this->datatype,
            'standalone'     => $this->isStandalone,
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
