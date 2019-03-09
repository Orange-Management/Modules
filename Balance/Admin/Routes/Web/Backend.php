<?php

use Modules\Balance\Controller\BackendController;
use Modules\Balance\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/controlling/balance/dashboard.*$' => [
        [
            'dest' => '\Modules\Balance\Controller\BackendController:viewBalanceDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::BALANCE,
            ],
        ],
    ],
];
