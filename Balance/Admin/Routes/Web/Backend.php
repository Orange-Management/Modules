<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Balance\Models\PermissionState;
use Modules\Balance\Controller\BackendController;

return [
    '^.*/backend/controlling/balance/dashboard.*$' => [
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
