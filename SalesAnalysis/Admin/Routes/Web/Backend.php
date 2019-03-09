<?php

use Modules\SalesAnalysis\Controller\BackendController;
use Modules\SalesAnalysis\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/sales/analysis/dashboard.*$' => [
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

    '^.*/sales/analysis/overview/dashboard.*$' => [
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
