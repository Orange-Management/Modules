<?php

use Modules\Production\Controller\BackendController;
use Modules\Production\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/production/list.*$' => [
        [
            'dest' => '\Modules\Production\Controller\BackendController:viewProductionList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PRODUCTION,
            ],
        ],
    ],
    '^.*/backend/production/create.*$' => [
        [
            'dest' => '\Modules\Production\Controller\BackendController:viewProductionCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PRODUCTION,
            ],
        ],
    ],
    '^.*/backend/production/process/list.*$' => [
        [
            'dest' => '\Modules\Production\Controller\BackendController:viewProductionProcessList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROCESS,
            ],
        ],
    ],
    '^.*/backend/production/process/create.*$' => [
        [
            'dest' => '\Modules\Production\Controller\BackendController:viewProductionProcessCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PROCESS,
            ],
        ],
    ],
];
