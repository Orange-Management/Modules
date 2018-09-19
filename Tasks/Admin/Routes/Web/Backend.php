<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Tasks\Models\PermissionState;
use Modules\Tasks\Controller\BackendController;

return [
    '^.*/backend/task/dashboard.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller\BackendController:viewTaskDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TASK,
            ],
        ],
    ],
    '^.*/backend/task/single.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller\BackendController:viewTaskView',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TASK,
            ],
        ],
    ],
    '^.*/backend/task/create.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller\BackendController:viewTaskCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TASK,
            ],
        ],
    ],
    '^.*/backend/task/analysis.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller\BackendController:viewTaskAnalysis',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ANALYSIS,
            ],
        ],
    ],
];
