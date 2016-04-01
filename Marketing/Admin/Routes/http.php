<?php

$httpRoutes = [
    '^.*/backend/marketing/promotion/list.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller:viewMarketingPromotionList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/marketing/promotion/create.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller:viewMarketingPromotionCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/marketing/event/list.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller:viewMarketingEventList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/marketing/event/create.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller:viewMarketingEventCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
