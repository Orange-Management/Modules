<?php

$httpRoutes = [
    '^.*/backend/rnd/list.*$' => [
        [
            'dest' => '\Modules\ResearchDevelopment\Controller:viewProjectList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/rnd/create.*$' => [
        [
            'dest' => '\Modules\ResearchDevelopment\Controller:viewProjectCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
