<?php

$httpRoutes = [
    '^.*/backend/warehousing/stock/arrival/list.*$' => [
        [
            'dest' => '\Modules\Arrival\Controller:viewArrivalList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/warehousing/stock/arrival/create.*$' => [
        [
            'dest' => '\Modules\Arrival\Controller:viewArrivalCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
