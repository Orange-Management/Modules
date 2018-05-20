<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/admin/exchange/import/list.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeImportList',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/exchange/export/list.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeExportList',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/exchange/import/profile.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeImport',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/exchange/export/profile.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeExport',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/exchange/dashboard.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeDashboard',
            'verb' => RouteVerb::GET,
        ],
    ],
];
