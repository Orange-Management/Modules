<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\ClientManagement\Models\PermissionState;
use Modules\ClientManagement\Controller\BackendController;


return [
    '^.*/backend/sales/client/list.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller\BackendController:viewClientManagementClientList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CLIENT,
            ],
        ],
    ],
    '^.*/backend/sales/client/create.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller\BackendController:viewClientManagementClientCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::CLIENT,
            ],
        ],
    ],
    '^.*/backend/sales/client/profile.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller\BackendController:viewClientManagementClientProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CLIENT,
            ],
        ],
    ],
    '^.*/backend/sales/client/analysis.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller\BackendController:viewClientManagementClientAnalysis',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ANALYSIS,
            ],
        ],
    ],
];
