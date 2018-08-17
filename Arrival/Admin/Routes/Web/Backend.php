<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Arrival\Models\PermissionState;
use Modules\Arrival\Controller;

return [
    '^.*/backend/warehouse/stock/arrival/list.*$' => [
        [
            'dest' => '\Modules\Arrival\Controller:viewArrivalList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ARRIVAL,
            ],
        ],
    ],
    '^.*/backend/warehouse/stock/arrival/create.*$' => [
        [
            'dest' => '\Modules\Arrival\Controller:viewArrivalCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ARRIVAL,
            ],
        ],
    ],
];
