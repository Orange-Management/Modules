<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Organization\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

use Modules\Organization\Controller\ApiController;
use Modules\Organization\Models\SettingsEnum;

return [
    [
        'name' => SettingsEnum::GROUP_GENERATE_AUTOMATICALLY_UNIT,
        'content' => '1',
        'module' => ApiController::MODULE_NAME,
    ],
    [
        'name' => SettingsEnum::GROUP_GENERATE_AUTOMATICALLY_DEPARTMENT,
        'content' => '1',
        'module' => ApiController::MODULE_NAME,
    ],
    [
        'name' => SettingsEnum::GROUP_GENERATE_AUTOMATICALLY_POSITION,
        'content' => '1',
        'module' => ApiController::MODULE_NAME,
    ],
];
