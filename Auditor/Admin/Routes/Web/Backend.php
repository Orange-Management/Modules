<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/admin/auditor/list.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller:viewAuditorList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/auditor/single.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller:viewAuditorSingle', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
