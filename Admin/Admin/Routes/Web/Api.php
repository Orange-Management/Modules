<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Admin\Models\PermissionState;
use Modules\Admin\Controller\ApiController;

return [
    '^.*/api/admin/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiSettingsSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::SETTINGS,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiSettingsGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SETTINGS,
            ],
        ],
    ],

    '^.*/api/admin/group.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiGroupCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::GROUP,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiGroupUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::GROUP,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiGroupDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::GROUP,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiGroupGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::GROUP,
            ],
        ],
    ],

    // todo: the order of find and account is bad but needed for now. otherwise the admin/account.* also matches and we match two routes = bad
    '^.*/api/admin/find/account.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAccountFind',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/api/admin/find/group.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiGroupFind',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],

    '^.*/api/admin/account.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAccountCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAccountUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAccountDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAccountGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],

    '^.*/api/admin/module/status.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiModuleStatusUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],

    '^.*/api/admin/group/account.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAddAccountToGroup',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],
    '^.*/api/admin/account/group.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAddGroupToAccount',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],

    '^.*/api/admin/group/permission.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAddGroupPermission',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::PERMISSION,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],
    '^.*/api/admin/account/permission.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAddAccountPermission',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::PERMISSION,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],
];
