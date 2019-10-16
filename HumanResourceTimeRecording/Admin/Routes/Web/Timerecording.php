<?php declare(strict_types=1);

use Modules\HumanResourceTimeRecording\Controller\TimerecordingController;
use Modules\HumanResourceTimeRecording\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^/timerecording$' => [
        [
            'dest' => '\Modules\HumanResourceTimeRecording\Controller\TimerecordingController:viewDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => TimerecordingController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
    '^.*/timerecording/dashboard.*$' => [
        [
            'dest' => '\Modules\HumanResourceTimeRecording\Controller\TimerecordingController:viewDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => TimerecordingController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
