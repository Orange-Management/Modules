<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/wiki.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:setUpBackend',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/wiki/dashboard.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseDashboard',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/wiki/category.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseCategory',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/wiki/doc.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseDoc',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/wiki/create.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseCreate',
            'verb' => RouteVerb::GET,
        ],
    ],
];
