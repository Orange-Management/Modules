<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Admin\Models\PermissionState;
use Modules\Admin\Controller;

return [
    '^.*/api/admin/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:apiSettingsSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::SETTINGS,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiSettingsGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SETTINGS,
            ],
        ],
    ],

    '^.*/api/admin/group.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:apiGroupCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::GROUP,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiGroupUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::GROUP,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiGroupDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::GROUP,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiGroupGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::GROUP,
            ],
        ],
    ],

    // todo: the order of find and account is bad but needed for now. otherwise the admin/account.* also matches and we match two routes = bad
    '^.*/api/admin/find/account.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:apiAccountFind',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],

    '^.*/api/admin/account.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:apiAccountCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiAccountUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiAccountDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiAccountGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],

    '^.*/api/admin/module/status.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:apiModuleStatusUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],
];
