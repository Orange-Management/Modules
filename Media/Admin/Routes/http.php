<?php

$httpRoutes = [
    '^.*/backend/accounting/personal/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewPersonalEntries', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
