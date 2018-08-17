<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Draw\Models\PermissionState;
use Modules\Draw\Controller;

return [
    '^.*/backend/draw/create.*$' => [
        [
            'dest' => '\Modules\Draw\Controller:setUpDrawEditor',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DRAW,
            ],
        ],
        [
            'dest' => '\Modules\Draw\Controller:viewDrawCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DRAW,
            ],
        ],
    ],
    '^.*/backend/draw/list.*$' => [
        [
            'dest' => '\Modules\Draw\Controller:viewDrawList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DRAW,
            ],
        ],
    ],
    '^.*/backend/draw/single.*$' => [
        [
            'dest' => '\Modules\Draw\Controller:setUpDrawEditor',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DRAW,
            ],
        ],
        [
            'dest' => '\Modules\Draw\Controller:viewDrawSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DRAW,
            ],
        ],
    ],
];
