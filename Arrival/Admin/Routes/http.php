<?php

return [
    '^.*/backend/warehousing/stock/arrival/list.*$' => [
        [
            'dest' => '\Modules\Arrival\Controller:viewArrivalList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/warehousing/stock/arrival/create.*$' => [
        [
            'dest' => '\Modules\Arrival\Controller:viewArrivalCreate', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
