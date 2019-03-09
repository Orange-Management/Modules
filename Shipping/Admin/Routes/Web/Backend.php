<?php

use Modules\Shipping\Controller\BackendController;
use Modules\Shipping\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/warehouse/shipping/list.*$' => [
        [
            'dest' => '\Modules\Shipping\Controller\BackendController:viewShippingList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SHIPPING,
            ],
        ],
    ],
    '^.*/warehouse/shipping/create.*$' => [
        [
            'dest' => '\Modules\Shipping\Controller\BackendController:viewShippingCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SHIPPING,
            ],
        ],
    ],
];
