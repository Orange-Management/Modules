<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/admin/exchange/import.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeImport',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/exchange/export.*$' => [
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
    '^.*/backend/admin/exchange/setup.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeSetup',
            'verb' => RouteVerb::GET,
        ],
    ],
];
