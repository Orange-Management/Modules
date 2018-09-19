<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\SalesAnalysis\Models\PermissionState;
use Modules\SalesAnalysis\Controller\BackendController;

return [
    '^.*/backend/sales/analysis/dashboard.*$' => [
        [
            'dest' => '\Modules\SalesAnalysis\Controller\BackendController:viewBackendDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],

    '^.*/backend/sales/analysis/overview/dashboard.*$' => [
        [
            'dest' => '\Modules\SalesAnalysis\Controller\BackendController:viewBackendOverviewDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
