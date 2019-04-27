<?php declare(strict_types=1);

use Modules\BudgetManagement\Controller\BackendController;
use Modules\BudgetManagement\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/controlling/budget/dashboard.*$' => [
        [
            'dest' => '\Modules\BudgetManagement\Controller\BackendController:viewBudgetingDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::BUDGET,
            ],
        ],
    ],
];
