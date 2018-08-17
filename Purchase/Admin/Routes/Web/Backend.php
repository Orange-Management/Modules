<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Purchase\Models\PermissionState;
use Modules\Purchase\Controller;

return [
    '^.*/backend/purchase/invoice/create.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseInvoiceCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::INVOICE,
            ],
        ],
    ],
    '^.*/backend/purchase/invoice/list.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseInvoiceList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::INVOICE,
            ],
        ],
    ],
    '^.*/backend/purchase/article/list.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseArticleList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ARTICLE,
            ],
        ],
    ],
    '^.*/backend/purchase/article/recommend.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseOrderRecommendation',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ARTICLE,
            ],
        ],
    ],
    '^.*/backend/purchase/article/create.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseArticleCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ARTICLE,
            ],
        ],
    ],
    '^.*/backend/purchase/article/profile.*$' => [
        [
            'dest' => '\Modules\Purchase\Controller:viewPurchaseArticleProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ARTICLE,
            ],
        ],
    ],
];
