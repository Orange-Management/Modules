<?php

use Modules\Dashboard\Controller\BackendController;
use Modules\Dashboard\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^(\/\?.*)$' => [
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
