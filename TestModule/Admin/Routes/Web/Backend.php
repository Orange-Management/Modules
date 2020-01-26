<?php declare(strict_types=1);

use Modules\TestModule\Controller\Controller;
use phpOMS\Router\RouteVerb;

return [
    '^.*/testmodule.*$' => [
        [
            'dest' => '\Modules\TestModule\Controller\Controller:testEndpoint',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => 1,
                'state' => 2,
            ],
        ],
    ],
];
