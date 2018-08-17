<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Billing\Models\PermissionState;
use Modules\Billing\Controller;

return [
    '^.*/backend/sales/invoice/create.*$' => [
        [
            'dest' => '\Modules\Billing\Controller:viewBillingInvoiceCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SALES_INVOICE,
            ],
        ],
    ],
    '^.*/backend/sales/invoice/list.*$' => [
        [
            'dest' => '\Modules\Billing\Controller:viewBillingInvoiceList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SALES_INVOICE,
            ],
        ],
    ],
    '^.*/backend/purchase/invoice/create.*$' => [
        [
            'dest' => '\Modules\Billing\Controller:viewBillingPurchaseInvoiceCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PURCHASE_INVOICE,
            ],
        ],
    ],
    '^.*/backend/purchase/invoice/list.*$' => [
        [
            'dest' => '\Modules\Billing\Controller:viewBillingPurchaInvoiceList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PURCHASE_INVOICE,
            ],
        ],
    ],
];
