<?php

return [
    '^.*/backend/controlling/budgeting/dashboard.*$' => [
        [
            'dest' => '\Modules\BudgetManagement\Controller:viewBudgetingDashboard', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
