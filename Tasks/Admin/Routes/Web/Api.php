<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/api/task(\?.*|$)' => [
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskCreate',
            'verb' => RouteVerb::PUT,
        ],
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskSet',
            'verb' => RouteVerb::SET,
        ],
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskGet',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/api/task/element.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskElementCreate',
            'verb' => RouteVerb::SET,
        ],
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskElementSet',
            'verb' => RouteVerb::SET,
        ],
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskElementGet',
            'verb' => RouteVerb::GET,
        ],
    ],
];
