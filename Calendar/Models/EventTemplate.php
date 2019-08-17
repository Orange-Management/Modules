<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Calendar\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

/**
 * Event template class.
 *
 * @package    Modules\Calendar\Models
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class EventTemplate extends Event
{
    /**
     * Type.
     *
     * @var int
     * @since 1.0.0
     */
    private int $type = EventType::TEMPLATE;
}
