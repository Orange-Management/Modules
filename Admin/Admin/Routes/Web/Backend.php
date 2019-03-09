<?php

use Modules\Admin\Controller\BackendController;
use Modules\Admin\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/admin/settings/general.*$' => [
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
    '^.*/admin/account/list.*$' => [
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
    '^.*/admin/account/settings.*$' => [
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
    '^.*/admin/account/create.*$' => [
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
    '^.*/admin/group/list.*$' => [
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
    '^.*/admin/group/settings.*$' => [
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
    '^.*/admin/group/create.*$' => [
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
    '^.*/admin/module/list.*$' => [
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
    '^.*/admin/module/settings\?.*$' => [
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
