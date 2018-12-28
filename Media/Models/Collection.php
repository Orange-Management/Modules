<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Media\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Media\Models;

/**
 * Media class.
 *
 * @package    Modules\Media\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Collection extends Media implements \Iterator
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
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set sources.
     *
     * @param array $sources Source array
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setSources(array $sources) : void
    {
        $this->sources = $sources;
    }

    /**
     * Set sources.
     *
     * @param int|Media $source Source
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function addSource($source) : void
    {
        $this->sources[] = $source;
    }

    /**
     * Get sources.
     *
     * @return array
     *
     * @since  1.0.0
     */
    public function getSources() : array
    {
        return $this->sources;
    }

    public function setExtension(string $extension) : void
    {
    }

    public function setVersioned(bool $versioned) : void
    {
    }

    public function rewind() : void
    {
        reset($this->sources);
    }

    public function current()
    {
        return current($this->sources);
    }

    public function key()
    {
        return key($this->sources);
    }

    public function next() : void
    {
        next($this->sources);
    }

    public function valid()
    {
        return current($this->sources) !== false;
    }
}
