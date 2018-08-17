<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Shipping\Models\PermissionState;
use Modules\Shipping\Controller;

return [
    '^.*/backend/warehouse/shipping/list.*$' => [
        [
            'dest' => '\Modules\Shipping\Controller:viewShippingList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SHIPPING,
            ],
        ],
    ],
    '^.*/backend/warehouse/shipping/create.*$' => [
        [
            'dest' => '\Modules\Shipping\Controller:viewShippingCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SHIPPING,
            ],
        ],
    ],
];
