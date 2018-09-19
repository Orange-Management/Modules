<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Monitoring\Models\PermissionState;
use Modules\Monitoring\Controller\BackendController;

return [
    '^.*/backend/admin/monitoring/general.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller\BackendController:viewMonitoringGeneral',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DASHBOARD,
            ],
        ],
    ],
    '^.*/backend/admin/monitoring/log/list.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller\BackendController:viewMonitoringLogList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::LOG,
            ],
        ],
    ],
    '^.*/backend/admin/monitoring/log/single.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller\BackendController:viewMonitoringLogEntry',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::LOG,
            ],
        ],
    ],
    '^.*/backend/admin/monitoring/security/dashboard.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller\BackendController:viewMonitoringSecurityDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SECURITY,
            ],
        ],
    ],
    '^.*/backend/admin/monitoring/security/file/list.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller\BackendController:viewMonitoringSecurityFileList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SECURITY,
            ],
        ],
    ],
];
