<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Tasks\Models\PermissionState;
use Modules\Tasks\Controller;

return [
    '^.*/backend/task/dashboard.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:viewTaskDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TASK,
            ],
        ],
    ],
    '^.*/backend/task/single.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:viewTaskView',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TASK,
            ],
        ],
    ],
    '^.*/backend/task/create.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:viewTaskCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TASK,
            ],
        ],
    ],
    '^.*/backend/task/analysis.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:viewTaskAnalysis',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ANALYSIS,
            ],
        ],
    ],
];
