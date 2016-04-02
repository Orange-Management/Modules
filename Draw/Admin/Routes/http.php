<?php

return [
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
        ],
    ],
    '^.*/backend/draw/list.*$' => [
        [
            'dest' => '\Modules\Draw\Controller:viewDrawList', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
