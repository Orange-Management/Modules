<?php declare(strict_types=1);

use Modules\HumanResourceTimeRecording\Controller\BackendController;
use Modules\HumanResourceTimeRecording\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/hr/timerecording/dashboard.*$' => [
        [
            'dest' => '\Modules\HumanResourceTimeRecording\Controller\BackendController:viewDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
