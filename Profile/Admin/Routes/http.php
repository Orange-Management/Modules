<?php

$httpRoutes = [
    '^.*/backend/profile/list.*$' => [
        [
            'dest' => '\Modules\Profile\Controller:viewProfileList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/profile/single.*$' => [
        [
            'dest' => '\Modules\Profile\Controller:viewProfileSingle', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
