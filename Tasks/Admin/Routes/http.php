<?php

$httpRoutes = [
    '^.*/backend/task/dashboard.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:viewTaskDashboard', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/task/single.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:viewTaskView', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/task/create.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:viewTaskCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/task/analysis.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:viewTaskAnalysis', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/api/task/create.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::JSON,
            'layout' => ViewLayout::NULL,
        ],
    ],
];
