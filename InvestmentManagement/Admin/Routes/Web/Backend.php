<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\InvestmentManagement\Models\PermissionState;
use Modules\InvestmentManagement\Controller\BackendController;

return [
    '^.*/backend/controlling/investment/dashboard.*$' => [
        [
            'dest' => '\Modules\InvestmentManagement\Controller\BackendController:viewInvestmentDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::INVESTMENT,
            ],
        ],
    ],
];
