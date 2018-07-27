<?php

use phpOMS\Router\RouteVerb;

return [
    '^$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewEmptyCommand',
            'verb' => RouteVerb::ANY,
        ],
    ],
];
