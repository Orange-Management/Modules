<?php declare(strict_types=1);

use Modules\Chart\Controller\BackendController;
use Modules\Chart\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/chart/create($|\?.*)' => [
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
    '^.*/chart/create/line.*$' => [
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
    '^.*/chart/list.*$' => [
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
