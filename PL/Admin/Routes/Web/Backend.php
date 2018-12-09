<?php

use Modules\PL\Controller\BackendController;
use Modules\PL\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

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
