<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Auditor\Models\PermissionState;
use Modules\Auditor\Controller\BackendController;

return [
    '^.*/backend/admin/audit/list.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller\BackendController:viewAuditorList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
    '^.*/backend/admin/audit/single.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller\BackendController:viewAuditorSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
    '^.*/backend/admin/audit/module/list.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller\BackendController:viewAuditorModuleList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
    '^.*/backend/admin/audit/module/single.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller\BackendController:viewAuditorModuleSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
    '^.*/backend/admin/audit/account/list.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller\BackendController:viewAuditorAccountList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
    '^.*/backend/admin/audit/account/single.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller\BackendController:viewAuditorAccountSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
];
