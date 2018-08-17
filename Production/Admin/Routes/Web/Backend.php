<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Production\Models\PermissionState;
use Modules\Production\Controller;

return [
    '^.*/backend/production/list.*$' => [
        [
            'dest' => '\Modules\Production\Controller:viewProductionList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PRODUCTION,
            ],
        ],
    ],
    '^.*/backend/production/create.*$' => [
        [
            'dest' => '\Modules\Production\Controller:viewProductionCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PRODUCTION,
            ],
        ],
    ],
    '^.*/backend/production/process/list.*$' => [
        [
            'dest' => '\Modules\Production\Controller:viewProductionProcessList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROCESS,
            ],
        ],
    ],
    '^.*/backend/production/process/create.*$' => [
        [
            'dest' => '\Modules\Production\Controller:viewProductionProcessCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PROCESS,
            ],
        ],
    ],
];
