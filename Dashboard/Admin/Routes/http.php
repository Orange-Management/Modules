<?php

return [
    '^.*/backend/dashboard/list.*$' => [
        [
            'dest' => '\Modules\Dashboard\Controller:viewDashboard', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
