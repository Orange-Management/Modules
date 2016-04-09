<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/dashboard/list.*$' => [
        [
            'dest' => '\Modules\Dashboard\Controller:viewDashboard', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
