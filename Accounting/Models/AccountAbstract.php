<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types = 1);

namespace Modules\Accounting\Models;


/**
 * Account abstraction class.
 *
 * @package    Module
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
abstract class AccountAbstract
{

    /**
     * Account ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected $id = 0;

    /**
     * Type.
     *
     * @var \Modules\Accounting\Models\AccountType
     * @since 1.0.0
     */
    protected $type = null;

    protected $positiveParent = null;
    
    protected $negativeParent = null;

    /**
     * Entry list.
     *
     * @var \Modules\Accounting\Models\EntryInterface[]
     * @since 1.0.0
     */
    protected $entryList = [];

    /**
     * Constructor.
     *
     * @param int $id Account ID
     *
     * @since  1.0.0
     */
    public function __construct(int $id = 0)
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get entry.
     *
     * @param int $id Entry ID
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function getEntryById($id)
    {
    }

    /**
     * Get entry.
     *
     * @param \DateTime $start Interval start
     * @param \DateTime $end   Interval end
     * @param int      $dateType
     *
     * @internal \Modules\Accounting\Models\TimeRangeType $dateTime Time range type
     *
     * @since    1.0.0
     */
    public function getEntriesByDate($start, $end, $dateType = TimeRangeType::RECEIPT_DATE)
    {
    }

    public function getPositiveParent() 
    {
        return $this->positiveParent;
    }

    public function setPositiveParent($parent)
    {
        $this->positiveParent = $parent;
    }

    public function getNegativeParent()
    {
        return $this->negativeParent;
    }

    public function setNegativeParent($parent)
    {
        $this->negativeParent = $parent;
    }
}
