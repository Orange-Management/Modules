<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Profile\Models\PermissionState;
use Modules\Profile\Controller;

return [
    '^.*/api/profile.*$' => [
        [
            'dest' => '\Modules\Profile\Controller:apiProfileCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PROFILE,
            ],
        ],
    ],
];