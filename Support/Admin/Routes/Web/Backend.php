<?php

use Modules\Support\Controller\BackendController;
use Modules\Support\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/support/list.*$' => [
        [
            'dest' => '\Modules\Support\Controller\BackendController:viewSupportList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SUPPORT,
            ],
        ],
    ],
    '^.*/backend/support/single.*$' => [
        [
            'dest' => '\Modules\Support\Controller\BackendController:viewSupportTicket',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SUPPORT,
            ],
        ],
    ],
    '^.*/backend/support/create.*$' => [
        [
            'dest' => '\Modules\Support\Controller\BackendController:viewSupportCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SUPPORT,
            ],
        ],
    ],
    '^.*/backend/support/analysis.*$' => [
        [
            'dest' => '\Modules\Support\Controller\BackendController:viewSupportAnalysis',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ANALYSIS,
            ],
        ],
    ],
    '^.*/backend/support/settings.*$' => [
        [
            'dest' => '\Modules\Support\Controller\BackendController:viewSupportSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SETTINGS,
            ],
        ],
    ],
    '^.*/backend/private/support/dashboard.*$' => [
        [
            'dest' => '\Modules\Support\Controller\BackendController:viewPrivateSupportDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
