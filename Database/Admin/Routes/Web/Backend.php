<?php

use Modules\Database\Controller\BackendController;
use Modules\Database\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/database/list.*$' => [
        [
            'dest' => '\Modules\Database\Controller\BackendController:viewDatabaseList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DATABASE,
            ],
        ],
    ],
    '^.*/backend/database/create.*$' => [
        [
            'dest' => '\Modules\Database\Controller\BackendController:viewDatabaseCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DATABASE,
            ],
        ],
    ],
    '^.*/backend/database/result.*$' => [
        [
            'dest' => '\Modules\Database\Controller\BackendController:viewDatabaseResult',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DATABASE,
            ],
        ],
    ],
    '^.*/backend/database/template.*$' => [
        [
            'dest' => '\Modules\Database\Controller\BackendController:viewDatabaseTemplate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
];
