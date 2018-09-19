<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\HumanResourcetimeRecording\Models\PermissionState;
use Modules\HumanResourcetimeRecording\Controller\BackendController;

return [
    '^.*/backend/hr/timerecording/dashboard.*$' => [
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
