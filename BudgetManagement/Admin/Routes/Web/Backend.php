<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\BudgetManagement\Models\PermissionState;
use Modules\BudgetManagement\Controller;

return [
    '^.*/backend/controlling/budget/dashboard.*$' => [
        [
            'dest' => '\Modules\BudgetManagement\Controller:viewBudgetingDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::BUDGET,
            ],
        ],
    ],
];
