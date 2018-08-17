<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\SupplierManagement\Models\PermissionState;
use Modules\SupplierManagement\Controller;

return [
    '^.*/backend/purchase/supplier/list.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller:viewSupplierManagementSupplierList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SUPPLIER,
            ],
        ],
    ],
    '^.*/backend/purchase/supplier/create.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller:viewSupplierManagementSupplierCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SUPPLIER,
            ],
        ],
    ],
    '^.*/backend/purchase/supplier/profile.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller:viewSupplierManagementSupplierProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SUPPLIER,
            ],
        ],
    ],
    '^.*/backend/purchase/supplier/analysis.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller:viewSupplierManagementSupplierAnalysis',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ANALYSIS,
            ],
        ],
    ],
];
