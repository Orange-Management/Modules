<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Knowledgebase\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Knowledgebase\Models;

/**
 * Wiki category class.
 *
 * @package Modules\Knowledgebase\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class WikiCategory implements \JsonSerializable
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * App id.
     *
     * There can be different wikis
     *
     * @var null|int|WikiApp
     * @since 1.0.0
     */
    private $app = null;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Path.
     *
     * @var string
     * @since 1.0.0
     */
    private string $path = '/';

    /**
     * Parent category.
     *
     * @var null|int|self
     * @since 1.0.0
     */
    private $parent = null;

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

    /**
     * Get app
     *
     * @return null|int|WikiApp
     *
     * @since 1.0.0
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Set app
     *
     * @param int $app App
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setApp(int $app) : void
    {
        $this->app = $app;
    }

    /**
     * Get name
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
     * Set name
     *
     * @param string $name Name
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
     * Get path
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * Set path
     *
     * @param string $path Path
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setPath(string $path) : void
    {
        $this->path = $path;
    }

    /**
     * Get parent category
     *
     * @return null|int|self
     *
     * @since 1.0.0
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set parent category
     *
     * @param int $parent Parent category
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setParent(int $parent) : void
    {
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'   => $this->id,
            'app'  => $this->app,
            'name' => $this->name,
            'path' => $this->path,
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
