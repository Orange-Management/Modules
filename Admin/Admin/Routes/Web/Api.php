<?php declare(strict_types=1);

use Modules\Admin\Controller\ApiController;
use Modules\Admin\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/admin/settings.*$' => [
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

    '^.*/admin/group$' => [
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

    '^.*/admin/find/account.*$' => [
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
    '^.*/admin/find/group.*$' => [
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
    '^.*/admin/find/accgrp.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAccountGroupFind',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],

    '^.*/admin/account$' => [
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

    '^.*/admin/module/status.*$' => [
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

    '^.*/admin/group/account.*$' => [
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
    '^.*/admin/account/group.*$' => [
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

    '^.*/admin/group/permission.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiGroupPermissionGet',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::PERMISSION,
                'state' => PermissionState::MODULE,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAddGroupPermission',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::PERMISSION,
                'state' => PermissionState::MODULE,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiGroupPermissionUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::PERMISSION,
                'state' => PermissionState::MODULE,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiGroupPermissionDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::PERMISSION,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],
    '^.*/admin/account/permission.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAccountPermissionGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::PERMISSION,
                'state' => PermissionState::MODULE,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAddAccountPermission',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::PERMISSION,
                'state' => PermissionState::MODULE,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAccountPermissionUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::PERMISSION,
                'state' => PermissionState::MODULE,
            ],
        ],
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiAccountPermissionDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::PERMISSION,
                'state' => PermissionState::MODULE,
            ],
        ],
    ],
    '^.*/admin/module/reinit.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiReInit',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ROUTE,
            ],
        ],
    ],

    '^.*/admin/update/url.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiUpdateFile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::APP,
            ],
        ],
    ],
    '^.*/admin/update/check.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiCheckForUpdates',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::APP,
            ],
        ],
    ],
    '^.*/admin/update/component.*$' => [
        [
            'dest' => '\Modules\Admin\Controller\ApiController:apiCheckForUpdates',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::APP,
            ],
        ],
    ],
];
