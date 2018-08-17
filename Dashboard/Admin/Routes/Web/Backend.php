<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Dashboard\Models\PermissionState;
use Modules\Dashboard\Controller;

return [
    '^.*/backend(\?.*)?$' => [
        [
            'dest' => '\Modules\Dashboard\Controller:viewDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
