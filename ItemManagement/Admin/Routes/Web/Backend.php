<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\ItemManagement\Models\PermissionState;
use Modules\ItemManagement\Controller;

return [
    '^.*/backend/sales/item/list.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementSalesList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SALES_ITEM,
            ],
        ],
    ],
    '^.*/backend/purchase/item/list.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementPurchaseList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PURCHASE_ITEM,
            ],
        ],
    ],
    '^.*/backend/warehouse/stock/list.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementWarehousingList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STOCK_ITEM,
            ],
        ],
    ],
    '^.*/backend/sales/item/create.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementSalesCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SALES_ITEM,
            ],
        ],
    ],
    '^.*/backend/purchase/item/create.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementPurchaseCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PURCHASE_ITEM,
            ],
        ],
    ],
    '.*/backend/warehouse/stock/create.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller:viewItemManagementWarehousingCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::STOCK_ITEM,
            ],
        ],
    ],
];
