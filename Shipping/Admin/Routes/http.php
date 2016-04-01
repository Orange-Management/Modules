<?php

$httpRoutes = [
    '^.*/backend/warehousing/shipping/list.*$' => [
        [
            'dest' => '\Modules\Shipping\Controller:viewShippingList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/warehousing/shipping/create.*$' => [
        [
            'dest' => '\Modules\Shipping\Controller:viewShippingCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
