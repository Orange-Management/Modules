<?php

$httpRoutes = [
    '^.*/backend/sales/client/list.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller:viewClientManagementClientList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/sales/client/create.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller:viewClientManagementClientCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/sales/client/profile.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller:viewClientManagementClientProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/sales/client/analysis.*$' => [
        [
            'dest' => '\Modules\ClientManagement\Controller:viewClientManagementClientAnalysis', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
