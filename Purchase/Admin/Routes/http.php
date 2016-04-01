<?php

$httpRoutes = [
    '^.*/backend/purchase/invoice/create.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseInvoiceCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/invoice/list.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseInvoiceList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/article/list.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseArticleList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/article/recommend.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseOrderRecommendation', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/article/create.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseArticleCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/article/profile.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseArticleProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
