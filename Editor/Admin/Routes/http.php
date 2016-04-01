<?php

$httpRoutes = [
    '^.*/backend/editor/create.*$' => [
        [
            'dest' => '\Modules\Editor\Controller:setUpEditorEditor', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::NULL,
        ],
        [
            'dest' => '\Modules\Editor\Controller:viewEditorCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/editor/list.*$' => [
        [
            'dest' => '\Modules\Editor\Controller:viewEditorList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
