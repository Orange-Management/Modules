<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Draw\Models\PermissionState;
use Modules\Draw\Controller;

return [
    '^.*/api/draw.*$' => [
        [
            'dest' => '\Modules\Draw\Controller:apiDrawCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DRAW,
            ],
        ],
    ],
];
