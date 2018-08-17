<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Chart\Models\PermissionState;
use Modules\Chart\Controller;

return [
    '^.*/backend/chart/create($|\?.*)' => [
        [
            'dest' => '\Modules\Chart\Controller:viewChartCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::CHART,
            ],
        ],
    ],
    '^.*/backend/chart/create/line.*$' => [
        [
            'dest' => '\Modules\Chart\Controller:setUpChartEditor',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CHART,
            ],
        ],
        [
            'dest' => '\Modules\Chart\Controller:viewChartCreateLine',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::CHART,
            ],
        ],
    ],
    '^.*/backend/chart/list.*$' => [
        [
            'dest' => '\Modules\Chart\Controller:viewChartList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CHART,
            ],
        ],
    ],
];
