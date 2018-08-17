<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\SalesAnalysis\Models\PermissionState;
use Modules\SalesAnalysis\Controller;

return [
    '^.*/backend/sales/analysis/dashboard.*$' => [
        [
            'dest' => '\Modules\SalesAnalysis\Controller:viewBackendDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],

    '^.*/backend/sales/analysis/overview/dashboard.*$' => [
        [
            'dest' => '\Modules\SalesAnalysis\Controller:viewBackendOverviewDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
