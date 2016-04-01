<?php

$httpRoutes = [
    '^.*/backend/accounting/costcenter/list.*$' => [
        [
            'dest' => '\Modules\CostCenterAccounting\Controller:viewCostCenterList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/costcenter/create.*$' => [
        [
            'dest' => '\Modules\CostCenterAccounting\Controller:viewCostCenterCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/costcenter/profile.*$' => [
        [
            'dest' => '\Modules\CostCenterAccounting\Controller:viewCostCenterProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
