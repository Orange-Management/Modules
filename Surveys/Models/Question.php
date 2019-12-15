<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Surveys\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Surveys\Models;

/**
 * Question class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Question
{
    /**
     * ID.
     *
     * @var   int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Name.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $name = '';

    /**
     * Description.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Get id.
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
     * Get name/title.
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
     * Set name/title.
     *
     * @param string $name Name/title
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
     * Get string.
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
     * Set description.
     *
     * @param string $desc Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription($desc) : void
    {
        $this->description = $desc;
    }
}
