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
     * @var array<int|Media>
     * @since 1.0.0
     */
    private $sources = [];

    /**
     * Extension name.
     *
     * @var string
     * @since 1.0.0
     */
    protected $extension = 'collection';

    /**
     * Versioned.
     *
     * @var bool
     * @since 1.0.0
     */
    protected $versioned = false;

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

    /**
     * {@inheritdoc}
     */
    public function setExtension(string $extension) : void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function setVersioned(bool $versioned) : void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function rewind() : void
    {
        \reset($this->sources);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return \current($this->sources);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return \key($this->sources);
    }

    /**
     * {@inheritdoc}
     */
    public function next() : void
    {
        \next($this->sources);
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return \current($this->sources) !== false;
    }
}
