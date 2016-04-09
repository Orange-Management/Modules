<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/accounting/personal/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewPersonalEntries', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
