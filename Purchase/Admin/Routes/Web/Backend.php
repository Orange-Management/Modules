<?php declare(strict_types=1);

use Modules\Purchase\Controller\BackendController;
use Modules\Purchase\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/purchase/invoice/create.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller\BackendController:viewPurchaseInvoiceCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::INVOICE,
            ],
        ],
    ],
    '^.*/purchase/invoice/list.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller\BackendController:viewPurchaseInvoiceList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::INVOICE,
            ],
        ],
    ],
    '^.*/purchase/article/list.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller\BackendController:viewPurchaseArticleList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ARTICLE,
            ],
        ],
    ],
    '^.*/purchase/article/recommend.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller\BackendController:viewPurchaseOrderRecommendation',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ARTICLE,
            ],
        ],
    ],
    '^.*/purchase/article/create.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller\BackendController:viewPurchaseArticleCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ARTICLE,
            ],
        ],
    ],
    '^.*/purchase/article/profile.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller\BackendController:viewPurchaseArticleProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ARTICLE,
            ],
        ],
    ],
];
