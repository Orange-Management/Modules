<?php

$httpRoutes = [
    '^.*/backend/support/list.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewSupportList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/support/single.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewSupportTicket', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/support/create.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewSupportCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/support/analysis.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewSupportAnalysis', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/support/settings.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewSupportSettings', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/private/support/dashboard.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewPrivateSupportDashboard', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
