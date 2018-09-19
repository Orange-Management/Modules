<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Billing\Models\PermissionState;
use Modules\Billing\Controller\BackendController;

return [
    '^.*/backend/sales/invoice/create.*$' => [
        [
            'dest' => '\Modules\Billing\Controller\BackendController:viewBillingInvoiceCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SALES_INVOICE,
            ],
        ],
    ],
    '^.*/backend/sales/invoice/list.*$' => [
        [
            'dest' => '\Modules\Billing\Controller\BackendController:viewBillingInvoiceList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SALES_INVOICE,
            ],
        ],
    ],
    '^.*/backend/purchase/invoice/create.*$' => [
        [
            'dest' => '\Modules\Billing\Controller\BackendController:viewBillingPurchaseInvoiceCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PURCHASE_INVOICE,
            ],
        ],
    ],
    '^.*/backend/purchase/invoice/list.*$' => [
        [
            'dest' => '\Modules\Billing\Controller\BackendController:viewBillingPurchaInvoiceList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PURCHASE_INVOICE,
            ],
        ],
    ],
];
