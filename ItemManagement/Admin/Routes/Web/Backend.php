<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\ItemManagement\Models\PermissionState;
use Modules\ItemManagement\Controller\BackendController;

return [
    '^.*/backend/sales/item/list.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller\BackendController:viewItemManagementSalesList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SALES_ITEM,
            ],
        ],
    ],
    '^.*/backend/purchase/item/list.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller\BackendController:viewItemManagementPurchaseList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PURCHASE_ITEM,
            ],
        ],
    ],
    '^.*/backend/warehouse/stock/list.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller\BackendController:viewItemManagementWarehousingList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STOCK_ITEM,
            ],
        ],
    ],
    '^.*/backend/sales/item/create.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller\BackendController:viewItemManagementSalesCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SALES_ITEM,
            ],
        ],
    ],
    '^.*/backend/purchase/item/create.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller\BackendController:viewItemManagementPurchaseCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PURCHASE_ITEM,
            ],
        ],
    ],
    '.*/backend/warehouse/stock/create.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller\BackendController:viewItemManagementWarehousingCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::STOCK_ITEM,
            ],
        ],
    ],
];
