<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Auditor\Models\PermissionState;
use Modules\Auditor\Controller;

return [
    '^.*/backend/admin/audit/list.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller:viewAuditorList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
    '^.*/backend/admin/audit/single.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller:viewAuditorSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
    '^.*/backend/admin/audit/module/list.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller:viewAuditorModuleList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
    '^.*/backend/admin/audit/module/single.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller:viewAuditorModuleSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
    '^.*/backend/admin/audit/account/list.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller:viewAuditorAccountList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
    '^.*/backend/admin/audit/account/single.*$' => [
        [
            'dest' => '\Modules\Auditor\Controller:viewAuditorAccountSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::AUDIT,
            ],
        ],
    ],
];
