<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Support\Models\PermissionState;
use Modules\Support\Controller;

return [
    '^.*/backend/support/list.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewSupportList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SUPPORT,
            ],
        ],
    ],
    '^.*/backend/support/single.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewSupportTicket',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SUPPORT,
            ],
        ],
    ],
    '^.*/backend/support/create.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewSupportCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SUPPORT,
            ],
        ],
    ],
    '^.*/backend/support/analysis.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewSupportAnalysis',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ANALYSIS,
            ],
        ],
    ],
    '^.*/backend/support/settings.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewSupportSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SETTINGS,
            ],
        ],
    ],
    '^.*/backend/private/support/dashboard.*$' => [
        [
            'dest' => '\Modules\Support\Controller:viewPrivateSupportDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
