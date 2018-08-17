<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\News\Models\PermissionState;
use Modules\News\Controller;

return [
    '^.*/api/news.*$' => [
        [
            'dest' => '\Modules\News\Controller:apiNewsCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::NEWS,
            ],
        ],
        [
            'dest' => '\Modules\News\Controller:apiNewsUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::NEWS,
            ],
        ],
        [
            'dest' => '\Modules\News\Controller:apiNewsGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::NEWS,
            ],
        ],
        [
            'dest' => '\Modules\News\Controller:apiNewsDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::NEWS,
            ],
        ],
    ],
];
