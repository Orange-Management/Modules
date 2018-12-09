<?php

use Modules\Profile\Controller\BackendController;
use Modules\Profile\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/profile.*$' => [
        [
            'dest' => '\Modules\Profile\Controller\BackendController:setupProfileStyles',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROFILE,
            ],
        ],
    ],
    '^.*/backend/profile/list.*$' => [
        [
            'dest' => '\Modules\Profile\Controller\BackendController:viewProfileList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROFILE,
            ],
        ],
    ],
    '^.*/backend/profile/single.*$' => [
        [
            'dest' => '\Modules\Profile\Controller\BackendController:viewProfileSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROFILE,
            ],
        ],
    ],
    '^.*/backend/admin/module/settings/profile/settings.*$' => [
        [
            'dest' => '\Modules\Profile\Controller\BackendController:viewProfileAdminSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROFILE,
            ],
        ],
    ],
    '^.*/backend/admin/module/settings/profile/create.*$' => [
        [
            'dest' => '\Modules\Profile\Controller\BackendController:viewProfileAdminCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROFILE,
            ],
        ],
    ],
];
