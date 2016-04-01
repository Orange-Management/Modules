<?php

$httpRoutes = [
    '^.*/backend/sales/item/list.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementSalesList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/item/list.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementPurchaseList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/warehousing/stock/list.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementWarehousingList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/sales/item/create.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementSalesCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/item/create.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementPurchaseCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '.*/backend/warehousing/stock/create.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementWarehousingCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
