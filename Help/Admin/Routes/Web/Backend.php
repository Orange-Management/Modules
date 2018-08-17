<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Help\Models\PermissionState;
use Modules\Help\Controller;

return [
    '^.*/backend/help/general(\?.*)?$' => [
        [
            'dest' => '\Modules\Help\Controller:viewHelpGeneral',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_GENERAL,
            ],
        ],
    ],
    '^.*/backend/help/module/list(\?.*)?$' => [
        [
            'dest' => '\Modules\Help\Controller:viewHelpModuleList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_MODULE,
            ],
        ],
    ],
    '^.*/backend/help/module/single(\?.*)?$' => [
        [
            'dest' => '\Modules\Help\Controller:viewHelpModule',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_MODULE,
            ],
        ],
    ],
    '^.*/backend/help/developer(\?.*)?$' => [
        [
            'dest' => '\Modules\Help\Controller:viewHelpDeveloper',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_DEVELOPER,
            ],
        ],
    ],
];
