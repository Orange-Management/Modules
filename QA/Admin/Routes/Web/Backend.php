<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/qa/dashboard.*$' => [
        [
            'dest' => '\Modules\QA\Controller:viewQADashboard',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/qa/category.*$' => [
        [
            'dest' => '\Modules\QA\Controller:viewQACategory',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/qa/question.*$' => [
        [
            'dest' => '\Modules\QA\Controller:viewQADoc',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/qa/create.*$' => [
        [
            'dest' => '\Modules\QA\Controller:viewQACreate',
            'verb' => RouteVerb::GET,
        ],
    ],
];
