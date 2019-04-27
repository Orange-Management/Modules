<?php declare(strict_types=1);

use Modules\Billing\Controller\BackendController;
use Modules\Billing\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/sales/invoice/create.*$' => [
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
    '^.*/sales/invoice/list.*$' => [
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
    '^.*/purchase/invoice/create.*$' => [
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
    '^.*/purchase/invoice/list.*$' => [
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
