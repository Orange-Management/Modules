<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/admin/log/list.*$' => [
        [
            'dest' => '\Modules\Logger\Controller:viewLogList',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/log/single.*$' => [
        [
            'dest' => '\Modules\Logger\Controller:viewLog',
            'verb' => RouteVerb::GET,
        ],
    ],
];
