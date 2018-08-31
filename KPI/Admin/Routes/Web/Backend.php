<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\KPI\Models\PermissionState;
use Modules\KPI\Controller;

return [
    '^.*/backend/controlling/kpi/dashboard.*$' => [
        [
            'dest' => '\Modules\KPI\Controller:viewKPIDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::KPI,
            ],
        ],
    ],
];
