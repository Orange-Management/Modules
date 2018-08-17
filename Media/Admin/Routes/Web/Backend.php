<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Media\Models\PermissionState;
use Modules\Media\Controller;

return [
    '^.*/backend/media/list.*$' => [
        [
            'dest' => '\Modules\Media\Controller:viewMediaList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MEDIA,
            ],
        ],
    ],
    '^.*/backend/media/create.*$' => [
        [
            'dest' => '\Modules\Media\Controller:setUpFileUploader',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::MEDIA,
            ],
        ],
        [
            'dest' => '\Modules\Media\Controller:viewMediaCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::MEDIA,
            ],
        ],
    ],
    '^.*/backend/media/single.*$' => [
        [
            'dest' => '\Modules\Media\Controller:viewMediaSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MEDIA,
            ],
        ],
    ],
];
