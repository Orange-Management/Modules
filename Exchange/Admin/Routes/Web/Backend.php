<?php

use Modules\Exchange\Controller\BackendController;
use Modules\Exchange\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/admin/exchange/import/list.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller\BackendController:viewExchangeImportList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::IMPORT,
            ],
        ],
    ],
    '^.*/backend/admin/exchange/export/list.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller\BackendController:viewExchangeExportList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::EXPORT,
            ],
        ],
    ],
    '^.*/backend/admin/exchange/import/profile.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller\BackendController:viewExchangeImport',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::IMPORT,
            ],
        ],
    ],
    '^.*/backend/admin/exchange/export/profile.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller\BackendController:viewExchangeExport',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::EXPORT,
            ],
        ],
    ],
    '^.*/backend/admin/exchange/dashboard.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller\BackendController:viewExchangeDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
];
