<?php

$httpRoutes = [
    '^.*/backend/accounting/receivable/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/receivable/create.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/receivable/profile.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/receivable/outstanding.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorOutstanding', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/receivable/age.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorAge', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/receivable/receivable.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorPayable', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/receivable/dun/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorDunList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/receivable/dso/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorDsoList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/receivable/journal/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewJournalList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/receivable/entries.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewEntriesList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/receivable/analyze.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewAnalyzeDashboard', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
