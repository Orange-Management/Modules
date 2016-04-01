<?php

$httpRoutes = [
    '^.*/backend/draw/create.*$' => [
        [
            'dest' => '\Modules\Draw\Controller:setUpDrawEditor', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::NULL,
        ],
        [
            'dest' => '\Modules\Draw\Controller:viewDrawCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/draw/list.*$' => [
        [
            'dest' => '\Modules\Draw\Controller:viewDrawList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
