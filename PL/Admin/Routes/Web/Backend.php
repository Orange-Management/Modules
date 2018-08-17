<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\PL\Models\PermissionState;
use Modules\PL\Controller;

return [
    '^.*/backend/controlling/pl/dashboard.*$' => [
        [
            'dest' => '\Modules\PL\Controller:viewPLDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
