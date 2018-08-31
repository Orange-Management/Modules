<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\InvestmentManagement\Models\PermissionState;
use Modules\InvestmentManagement\Controller;

return [
    '^.*/backend/controlling/investment/dashboard.*$' => [
        [
            'dest' => '\Modules\InvestmentManagement\Controller:viewInvestmentDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::INVESTMENT,
            ],
        ],
    ],
];
