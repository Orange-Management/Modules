<?php declare(strict_types=1);

use Modules\ItemManagement\Controller\BackendController;
use Modules\ItemManagement\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/sales/item/list.*$' => [
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
    '^.*/purchase/item/list.*$' => [
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
    '^.*/warehouse/stock/list.*$' => [
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
    '^.*/sales/item/create.*$' => [
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
    '^.*/purchase/item/create.*$' => [
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
    '.*/warehouse/stock/create.*$' => [
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
    '^.*/sales/item/single.*$' => [
        [
            'dest' => '\Modules\ItemManagement\Controller\BackendController:viewItemManagementSalesItem',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SALES_ITEM,
            ],
        ],
    ],
];
