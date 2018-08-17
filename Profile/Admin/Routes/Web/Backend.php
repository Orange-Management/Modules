<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Profile\Models\PermissionState;
use Modules\Profile\Controller;

return [
    '^.*/backend/profile.*$' => [
        [
            'dest' => '\Modules\Profile\Controller:setupProfileStyles',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROFILE,
            ],
        ],
    ],
    '^.*/backend/profile/list.*$' => [
        [
            'dest' => '\Modules\Profile\Controller:viewProfileList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROFILE,
            ],
        ],
    ],
    '^.*/backend/profile/single.*$' => [
        [
            'dest' => '\Modules\Profile\Controller:viewProfileSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROFILE,
            ],
        ],
    ],
];
