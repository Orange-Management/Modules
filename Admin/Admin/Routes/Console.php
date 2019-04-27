<?php declare(strict_types=1);

use phpOMS\Router\RouteVerb;

return [
    '^$' => [
        [
            'dest' => '\Modules\Admin\ConsoleController:viewEmptyCommand',
            'verb' => RouteVerb::ANY,
        ],
    ],
];
