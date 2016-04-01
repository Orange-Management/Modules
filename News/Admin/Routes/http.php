<?php

$httpRoutes = [
    '^.*/backend/news/dashboard.*$' => [
        [
            'dest' => '\Modules\News\Controller:viewNewsDashboard', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/news/article.*$' => [
        [
            'dest' => '\Modules\News\Controller:viewNewsArticle', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/news/archive.*$' => [
        [
            'dest' => '\Modules\News\Controller:viewNewsArchive', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/news/create.*$' => [
        [
            'dest' => '\Modules\News\Controller:viewNewsCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
