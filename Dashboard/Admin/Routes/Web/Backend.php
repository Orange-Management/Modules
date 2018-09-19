<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Dashboard\Models\PermissionState;
use Modules\Dashboard\Controller\BackendController;

return [
    '^.*/backend(\?.*)?$' => [
        [
            'dest' => '\Modules\Dashboard\Controller\BackendController:viewDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
