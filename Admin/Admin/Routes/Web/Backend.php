<?php

use Modules\Admin\Controller\BackendController;
use Modules\Admin\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/admin/settings/general.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\BackendController:viewSettingsGeneral',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SETTINGS,
            ],
        ],
    ],
    '^.*/backend/admin/account/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\BackendController:viewAccountList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/backend/admin/account/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\BackendController:viewAccountSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/backend/admin/account/create.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\BackendController:viewAccountCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/backend/admin/group/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\BackendController:viewGroupList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::GROUP,
            ],
        ],
    ],
    '^.*/backend/admin/group/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\BackendController:viewGroupSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::GROUP,
            ],
        ],
    ],
    '^.*/backend/admin/group/create.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\BackendController:viewGroupCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::GROUP,
            ],
        ],
    ],
    '^.*/backend/admin/module/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\BackendController:viewModuleList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],
    '^.*/backend/admin/module/settings\?.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\BackendController:viewModuleProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],
];
