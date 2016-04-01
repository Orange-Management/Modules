<?php

$httpRoutes = [
    '^.*/backend/accounting/costobject/list.*$' => [
        [
            'dest' => '\Modules\CostObjectAccounting\Controller:viewCostObjectList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/costobject/create.*$' => [
        [
            'dest' => '\Modules\CostObjectAccounting\Controller:viewCostObjectCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/costobject/profile.*$' => [
        [
            'dest' => '\Modules\CostObjectAccounting\Controller:viewCostObjectProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
