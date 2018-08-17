<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\HumanResourcetimeRecording\Models\PermissionState;
use Modules\HumanResourcetimeRecording\Controller;

return [
    '^.*/backend/hr/timerecording/dashboard.*$' => [
        [
            'dest' => '\Modules\HumanResourceTimeRecording\Controller:viewDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
