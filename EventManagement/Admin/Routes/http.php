<?php

$httpRoutes = [
    '^.*/backend/eventmanagement/list.*$' => [
        [
            'dest' => '\Modules\EventManagement\Controller:viewEventManagementList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/eventmanagement/create.*$' => [
        [
            'dest' => '\Modules\EventManagement\Controller:viewEventManagementCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/eventmanagement/profile.*$' => [
        [
            'dest' => '\Modules\EventManagement\Controller:viewEventManagementProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
