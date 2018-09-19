<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Chart\Models\PermissionState;
use Modules\Chart\Controller\BackendController;

return [
    '^.*/backend/chart/create($|\?.*)' => [
        [
            'dest' => '\Modules\Chart\Controller\BackendController:viewChartCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::CHART,
            ],
        ],
    ],
    '^.*/backend/chart/create/line.*$' => [
        [
            'dest' => '\Modules\Chart\Controller\BackendController:setUpChartEditor',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CHART,
            ],
        ],
        [
            'dest' => '\Modules\Chart\Controller\BackendController:viewChartCreateLine',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::CHART,
            ],
        ],
    ],
    '^.*/backend/chart/list.*$' => [
        [
            'dest' => '\Modules\Chart\Controller\BackendController:viewChartList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CHART,
            ],
        ],
    ],
];
