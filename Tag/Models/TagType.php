<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Tag
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tag\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Tag type enum.
 *
 * @package    Modules\Tag
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
abstract class TagType extends Enum
{
    public const SINGLE = 1;
    public const SHARED = 2;
}
