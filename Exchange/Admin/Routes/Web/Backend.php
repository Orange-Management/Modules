<?php declare(strict_types=1);

use Modules\Exchange\Controller\BackendController;
use Modules\Exchange\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/admin/exchange/import/list.*$' => [
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
    '^.*/admin/exchange/export/list.*$' => [
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
    '^.*/admin/exchange/import/profile.*$' => [
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
    '^.*/admin/exchange/export/profile.*$' => [
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
    '^.*/admin/exchange/dashboard.*$' => [
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
