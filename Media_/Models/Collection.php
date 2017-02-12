<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Media\Models;

/**
 * Media class.
 *
 * @category   Modules
 * @package    Modules\Media
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Collection extends Media
{

    /**
     * Resource id.
     *
     * @var int[]
     * @since 1.0.0
     */
    private $sources = [];

    protected $extension = 'collection';
    protected $versioned = false;

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * Set sources.
     *
     * @param array $sources Source array
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setSources(array $sources)
    {
        $this->sources = $sources;
    }

    /**
     * Set sources.
     *
     * @param int $source Source
     *
     * @return void
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addSource(int $source)
    {
        $this->sources[] = $source;
    }

    /**
     * Get sources.
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getSources() : array
    {
        return $this->sources;
    }

    public function setExtension(string $extension)
    {
    }

    public function setVersioned(bool $versioned)
    {
    }
}
