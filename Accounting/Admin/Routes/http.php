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
    '^.*/backend/accounting/impersonal/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewImpersonalEntries', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewEntries', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/impersonal/journal/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewJournalList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/stack/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewStackList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/stack/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewStackEntries', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/stack/archive/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewStackArchiveList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/stack/create.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewStackCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/stack/predefined/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewStackPredefinedList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/gl/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewGLList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/gl/create.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewGLCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/accounting/gl/profile.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewGLProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/api/accounting/dun/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewCostCenterProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/api/accounting/statement/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewCostCenterProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/api/accounting/balances/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewCostCenterProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/api/accounting/accountform/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewCostCenterProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
