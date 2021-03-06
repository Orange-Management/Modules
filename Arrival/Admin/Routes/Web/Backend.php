<?php declare(strict_types=1);

use Modules\Arrival\Controller\BackendController;
use Modules\Arrival\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/warehouse/stock/arrival/list.*$' => [
        [
            'dest' => '\Modules\Arrival\Controller\BackendController:viewArrivalList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ARRIVAL,
            ],
        ],
    ],
    '^.*/warehouse/stock/arrival/create.*$' => [
        [
            'dest' => '\Modules\Arrival\Controller\BackendController:viewArrivalCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ARRIVAL,
            ],
        ],
    ],
];
