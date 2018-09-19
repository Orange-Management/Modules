<?php

use phpOMS\Router\RouteVerb;

return [
    '^$' => [
        [
            'dest' => '\Modules\Admin\ConsoleController:viewEmptyCommand',
            'verb' => RouteVerb::ANY,
        ],
    ],
];
