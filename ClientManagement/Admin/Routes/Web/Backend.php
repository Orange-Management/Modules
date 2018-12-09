<?php

use Modules\ClientManagement\Controller\BackendController;
use Modules\ClientManagement\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;


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
