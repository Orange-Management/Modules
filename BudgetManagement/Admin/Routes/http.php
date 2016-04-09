<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/controlling/budgeting/dashboard.*$' => [
        [
            'dest' => '\Modules\BudgetManagement\Controller:viewBudgetingDashboard', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
