<?php

$httpRoutes = [
    '^.*/backend/controlling/budgeting/dashboard.*$' => [
        [
            'dest' => '\Modules\BudgetManagement\Controller:viewBudgetingDashboard', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
