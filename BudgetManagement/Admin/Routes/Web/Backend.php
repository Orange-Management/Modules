<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\BudgetManagement\Models\PermissionState;
use Modules\BudgetManagement\Controller\BackendController;

return [
    '^.*/backend/controlling/budget/dashboard.*$' => [
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
