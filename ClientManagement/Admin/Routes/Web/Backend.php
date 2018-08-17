<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\ClientManagement\Models\PermissionState;
use Modules\ClientManagement\Controller;


return [
    '^.*/backend/sales/client/list.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller:viewClientManagementClientList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CLIENT,
            ],
        ],
    ],
    '^.*/backend/sales/client/create.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller:viewClientManagementClientCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::CLIENT,
            ],
        ],
    ],
    '^.*/backend/sales/client/profile.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller:viewClientManagementClientProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CLIENT,
            ],
        ],
    ],
    '^.*/backend/sales/client/analysis.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller:viewClientManagementClientAnalysis',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ANALYSIS,
            ],
        ],
    ],
];
