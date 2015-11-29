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
namespace Modules\Reporter\Models;
use phpOMS\Contract\Object;


/**
 * Template model.
 *
 * @category   Framework
 * @package    phpOMS\Auth
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Template
{

    /**
     * Template Id.
     *
     * @var \int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Template status.
     *
     * @var \int
     * @since 1.0.0
     */
    private $status = ReporterStatus::ACTIVE;

    /**
     * Template data source.
     *
     * @var \int
     * @since 1.0.0
     */
    private $datatype = TemplateDataType::OTHER;

    /**
     * Template name.
     *
     * @var \string
     * @since 1.0.0
     */
    private $name = '';

    /**
     * Template description.
     *
     * @var \string
     * @since 1.0.0
     */
    private $description = '';

    /**
     * Template created at.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $createdAt = null;

    /**
     * Template created by.
     *
     * @var \int
     * @since 1.0.0
     */
    private $createdBy = 0;

    /**
     * Template source.
     *
     * @var \int
     * @since 1.0.0
     */
    private $source = 0;

    /**
     * Expected files.
     *
     * @var array
     * @since 1.0.0
     */
    private $expected = [];

    /**
     * Permissions.
     *
     * @var array
     * @since 1.0.0
     */
    private $permissions = [
        'r' => ['groups' => [],
                'users'  => [],],
        'w' => ['groups' => [],
                'users'  => [],],
        'p' => ['groups' => [],
                'users'  => [],],
        'd' => ['groups' => [],
                'users'  => [],],
    ];

    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId() : \int
    {
        return $this->id;
    }

    /**
     * @param \string $name Template name
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setName(\string $name)
    {
        $this->name = $name;
    }

    /**
     * @return \string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getName() : \string
    {
        return $this->name;
    }

    /**
     * @param \string $description Template description
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDescription(\string $description)
    {
        $this->description = $description;
    }

    /**
     * @return \string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDescription() : \string
    {
        return $this->description;
    }

    /**
     * @param \int $source Source
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setSource(\int $source)
    {
        $this->source = $source;
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getSource() : \int
    {
        return $this->source;
    }

    /**
     * @param \int $createdBy Creator
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreatedBy(\int $createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @param \DateTime $createdAt Creation date
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreatedBy() : \int
    {
        return $this->createdBy;
    }

    /**
     * @return \DateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param array $expected Expected files
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setExpected(array $expected)
    {
        $this->expected = $expected;
    }

    /**
     * @return \array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getExpected() : array
    {
        return $this->expected;
    }

    /**
     * @param \string $expected Expected file
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addExpected(\string $expected)
    {
        $this->expected[] = $expected;
    }

    /**
     * @param \int $status Template status (is active?)
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setStatus(\int $status)
    {
        $this->status = $status;
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStatus() : \int
    {
        return $this->status;
    }

    /**
     * @param \int $datatype Template datatype source
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDatatype(\int $datatype)
    {
        $this->datatype = $datatype;
    }

    /**
     * @return \int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDatatype() : \int
    {
        return $this->datatype;
    }
}
