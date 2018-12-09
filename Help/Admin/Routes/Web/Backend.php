<?php

use Modules\Help\Controller\BackendController;
use Modules\Help\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/help/general(\?.*)?$' => [
        [
            'dest' => '\Modules\Help\Controller\BackendController:viewHelpGeneral',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_GENERAL,
            ],
        ],
    ],
    '^.*/backend/help/module/list(\?.*)?$' => [
        [
            'dest' => '\Modules\Help\Controller\BackendController:viewHelpModuleList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_MODULE,
            ],
        ],
    ],
    '^.*/backend/help/module/single(\?.*)?$' => [
        [
            'dest' => '\Modules\Help\Controller\BackendController:viewHelpModule',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_MODULE,
            ],
        ],
    ],
    '^.*/backend/help/developer(\?.*)?$' => [
        [
            'dest' => '\Modules\Help\Controller\BackendController:viewHelpDeveloper',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_DEVELOPER,
            ],
        ],
    ],
];
