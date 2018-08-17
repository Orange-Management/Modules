<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Exchange\Models\PermissionState;
use Modules\Exchange\Controller;

return [
    '^.*/backend/admin/exchange/import/list.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeImportList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::IMPORT,
            ],
        ],
    ],
    '^.*/backend/admin/exchange/export/list.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeExportList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::EXPORT,
            ],
        ],
    ],
    '^.*/backend/admin/exchange/import/profile.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeImport',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::IMPORT,
            ],
        ],
    ],
    '^.*/backend/admin/exchange/export/profile.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeExport',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::EXPORT,
            ],
        ],
    ],
    '^.*/backend/admin/exchange/dashboard.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller:viewExchangeDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
