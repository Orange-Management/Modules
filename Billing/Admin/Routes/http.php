<?php

$httpRoutes = [
    '^.*/backend/sales/invoice/create.*$' => [
        [
            'dest' => '\Modules\Billing\Controller:viewBillingInvoiceCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/sales/invoice/list.*$' => [
        [
            'dest' => '\Modules\Billing\Controller:viewBillingInvoiceList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/invoice/create.*$' => [
        [
            'dest' => '\Modules\Billing\Controller:viewBillingPurchaseInvoiceCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/purchase/invoice/list.*$' => [
        [
            'dest' => '\Modules\Billing\Controller:viewBillingPurchaInvoiceList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
