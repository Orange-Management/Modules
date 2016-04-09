<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/profile/list.*$' => [
        [
            'dest' => '\Modules\Profile\Controller:viewProfileList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/profile/single.*$' => [
        [
            'dest' => '\Modules\Profile\Controller:viewProfileSingle', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
