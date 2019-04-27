<?php declare(strict_types=1);

use Modules\Production\Controller\BackendController;
use Modules\Production\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/production/list.*$' => [
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
    '^.*/production/create.*$' => [
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
    '^.*/production/process/list.*$' => [
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
    '^.*/production/process/create.*$' => [
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
