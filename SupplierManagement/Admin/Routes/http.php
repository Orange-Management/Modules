<?php

$httpRoutes = [
    '^.*/backend/purchase/supplier/list.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller:viewSupplierManagementSupplierList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/supplier/create.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller:viewSupplierManagementSupplierCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/supplier/profile.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller:viewSupplierManagementSupplierProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/supplier/analysis.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller:viewSupplierManagementSupplierAnalysis', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
