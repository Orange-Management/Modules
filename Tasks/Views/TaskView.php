<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Tasks\Views;

use phpOMS\Views\View;
use phpOMS\ApplicationAbstract;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use Modules\Tasks\Models\TaskStatus;

class TaskView extends View
{
    protected $media = [];

    public function getStatus(int $status) : string
    {
        if ($status === TaskStatus::OPEN) {
            return 'darkblue';
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
