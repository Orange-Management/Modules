<?php

$httpRoutes = [
    '^.*/backend/projectmanagement/list.*$' => [
        [
            'dest' => '\Modules\ProjectManagement\Controller:viewProjectManagementList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/projectmanagement/create.*$' => [
        [
            'dest' => '\Modules\ProjectManagement\Controller:viewProjectManagementCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/projectmanagement/profile.*$' => [
        [
            'dest' => '\Modules\ProjectManagement\Controller:viewProjectManagementProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
