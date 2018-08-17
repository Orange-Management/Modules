<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Database\Models\PermissionState;
use Modules\Database\Controller;

return [
    '^.*/backend/database/list.*$' => [
        [
            'dest' => '\Modules\Database\Controller:viewDatabaseList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DATABASE,
            ],
        ],
    ],
    '^.*/backend/database/create.*$' => [
        [
            'dest' => '\Modules\Database\Controller:viewDatabaseCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DATABASE,
            ],
        ],
    ],
    '^.*/backend/database/result.*$' => [
        [
            'dest' => '\Modules\Database\Controller:viewDatabaseResult',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DATABASE,
            ],
        ],
    ],
    '^.*/backend/database/template.*$' => [
        [
            'dest' => '\Modules\Database\Controller:viewDatabaseTemplate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
];
