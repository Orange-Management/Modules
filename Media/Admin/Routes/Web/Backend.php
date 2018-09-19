<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Media\Models\PermissionState;
use Modules\Media\Controller\BackendController;

return [
    '^.*/backend/media/list.*$' => [
        [
            'dest' => '\Modules\Media\Controller\BackendController:viewMediaList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MEDIA,
            ],
        ],
    ],
    '^.*/backend/media/create.*$' => [
        [
            'dest' => '\Modules\Media\Controller\BackendController:setUpFileUploader',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::MEDIA,
            ],
        ],
        [
            'dest' => '\Modules\Media\Controller\BackendController:viewMediaCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::MEDIA,
            ],
        ],
    ],
    '^.*/backend/media/single.*$' => [
        [
            'dest' => '\Modules\Media\Controller\BackendController:viewMediaSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MEDIA,
            ],
        ],
    ],
];
