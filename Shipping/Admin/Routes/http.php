<?php

return [
    '^.*/backend/warehousing/shipping/list.*$' => [
        [
            'dest' => '\Modules\Shipping\Controller:viewShippingList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/warehousing/shipping/create.*$' => [
        [
            'dest' => '\Modules\Shipping\Controller:viewShippingCreate', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
