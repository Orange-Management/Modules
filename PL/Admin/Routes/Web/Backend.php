<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\PL\Models\PermissionState;
use Modules\PL\Controller\BackendController;

return [
    '^.*/backend/controlling/pl/dashboard.*$' => [
        [
            'dest' => '\Modules\PL\Controller\BackendController:viewPLDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
