<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Tasks
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tasks\Views;

use Modules\Tasks\Models\TaskStatus;
use phpOMS\Views\View;

/**
 * Task view class.
 *
 * @package Modules\Tasks
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class TaskView extends View
{
    /**
     * Get task status color.
     *
     * @param int $status Status
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getStatus(int $status) : string
    {
        if ($status === TaskStatus::OPEN) {
            return 'darkblue';
        } elseif ($status === TaskStatus::DONE) {
            return 'green';
        } elseif ($status === TaskStatus::WORKING) {
            return 'purple';
        } elseif ($status === TaskStatus::CANCELED) {
            return 'red';
        } elseif ($status === TaskStatus::SUSPENDED) {
            return 'yellow';
        }

        return 'black';
    }
}
