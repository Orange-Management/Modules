<?php

$httpRoutes = [
    '^.*/backend/accounting/payable/list.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/payable/create.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/payable/profile.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/payable/outstanding.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorOutstanding', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/payable/age.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorAge', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/payable/payable.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorPayable', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/payable/journal/list.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewJournalList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/payable/entries.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewEntriesList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/payable/analyze.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewAnalyzeDashboard', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
