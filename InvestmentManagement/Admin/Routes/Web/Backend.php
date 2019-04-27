<?php declare(strict_types=1);

use Modules\InvestmentManagement\Controller\BackendController;
use Modules\InvestmentManagement\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/controlling/investment/dashboard.*$' => [
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
