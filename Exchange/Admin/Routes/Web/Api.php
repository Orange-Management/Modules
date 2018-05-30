<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/api/admin/exchange/import/profile.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:apiExchangeImport',
            'verb' => RouteVerb::SET,
        ],
    ],
    '^.*/api/admin/exchange/export/profile.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:apiExchangeExport',
            'verb' => RouteVerb::SET,
        ],
    ],
];
