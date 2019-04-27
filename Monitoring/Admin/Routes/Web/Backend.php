<?php declare(strict_types=1);

use Modules\Monitoring\Controller\BackendController;
use Modules\Monitoring\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/admin/monitoring/general.*$' => [
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
    '^.*/admin/monitoring/log/list.*$' => [
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
    '^.*/admin/monitoring/log/single.*$' => [
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
    '^.*/admin/monitoring/security/dashboard.*$' => [
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
    '^.*/admin/monitoring/security/file/list.*$' => [
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
