<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Purchase\Models\PermissionState;
use Modules\Purchase\Controller\BackendController;

return [
    '^.*/backend/purchase/invoice/create.*$' => [
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
    '^.*/backend/purchase/invoice/list.*$' => [
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
    '^.*/backend/purchase/article/list.*$' => [
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
    '^.*/backend/purchase/article/recommend.*$' => [
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
    '^.*/backend/purchase/article/create.*$' => [
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
    '^.*/backend/purchase/article/profile.*$' => [
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
