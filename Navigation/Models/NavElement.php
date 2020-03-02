<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Navigation\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Navigation\Models;

/**
 * Navigation element class.
 *
 * @package Modules\Navigation\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class NavElement
{
    public int $id                 = 0;
    public string $pid             = '';
    public string $name            = '';
    public int $type               = 1;
    public int $subtype            = 2;
    public ?string $icon           = null;
    public ?string $uri            = null;
    public string $target          = 'self';
    public ?string $action         = null;
    public string $from            = '0';
    public int $order              = 1;
    public int $parent             = 0;
    public ?int $permissionPerm    = null;
    public ?int $permissionType    = null;
    public ?int $permissionElement = null;
}
