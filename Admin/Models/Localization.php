<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Admin\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\Models;

use phpOMS\Localization\Localization as FrameworkLocalization;

/**
 * Localization.
 *
 * @package Modules\Admin\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Localization extends FrameworkLocalization
{
    /**
     * Country id.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Get id
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }
}
