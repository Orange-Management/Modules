<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Balance\Models\PermissionState;
use Modules\Balance\Controller;

return [
    '^.*/backend/controlling/balance/dashboard.*$' => [
        [
            'dest' => '\Modules\Balance\Controller:viewBalanceDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::BALANCE,
            ],
        ],
    ],
];
