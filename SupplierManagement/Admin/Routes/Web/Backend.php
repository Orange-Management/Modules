<?php

use Modules\SupplierManagement\Controller\BackendController;
use Modules\SupplierManagement\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/purchase/supplier/list.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller\BackendController:viewSupplierManagementSupplierList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SUPPLIER,
            ],
        ],
    ],
    '^.*/purchase/supplier/create.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller\BackendController:viewSupplierManagementSupplierCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SUPPLIER,
            ],
        ],
    ],
    '^.*/purchase/supplier/profile.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller\BackendController:viewSupplierManagementSupplierProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SUPPLIER,
            ],
        ],
    ],
    '^.*/purchase/supplier/analysis.*$' => [
        [
            'dest' => '\Modules\SupplierManagement\Controller\BackendController:viewSupplierManagementSupplierAnalysis',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ANALYSIS,
            ],
        ],
    ],
];
