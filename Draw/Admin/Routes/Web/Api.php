<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/draw.*$' => [
        [
            'dest' => '\Modules\Draw\Controller:apiDrawCreate', 
            'verb' => RouteVerb::SET,
        ],
    ],
];
