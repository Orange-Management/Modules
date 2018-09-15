<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Admin\Models\PermissionState;
use Modules\Admin\Controller;

return [
    '^.*/backend/admin/settings/general.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewSettingsGeneral',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SETTINGS,
            ],
        ],
    ],
    '^.*/backend/admin/account/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewAccountList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/backend/admin/account/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewAccountSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/backend/admin/account/create.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewAccountCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/backend/admin/group/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewGroupList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::GROUP,
            ],
        ],
    ],
    '^.*/backend/admin/group/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewGroupSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::GROUP,
            ],
        ],
    ],
    '^.*/backend/admin/group/create.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewGroupCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::GROUP,
            ],
        ],
    ],
    '^.*/backend/admin/module/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewModuleList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],
    '^.*/backend/admin/module/settings\?.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewModuleProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],
];
