<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/api/news.*$' => [
        [
            'dest' => '\Modules\News\Controller:apiNewsCreate',
            'verb' => RouteVerb::PUT,
        ],
        [
            'dest' => '\Modules\News\Controller:apiNewsUpdate',
            'verb' => RouteVerb::SET,
        ],
        [
            'dest' => '\Modules\News\Controller:apiNewsGet',
            'verb' => RouteVerb::GET,
        ],
        [
            'dest' => '\Modules\News\Controller:apiNewsDelete',
            'verb' => RouteVerb::DELETE,
        ],
    ],
];
