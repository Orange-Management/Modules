<?php

$httpRoutes = [
    '^.*/backend/dashboard/list.*$' => [
        [
            'dest' => '\Modules\Dashboard\Controller:viewDashboard', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
