<?php

use Modules\Marketing\Controller\BackendController;
use Modules\Marketing\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/marketing/promotion/list.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller\BackendController:viewMarketingPromotionList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROMOTION,
            ],
        ],
    ],
    '^.*/marketing/promotion/create.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller\BackendController:viewMarketingPromotionCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PROMOTION,
            ],
        ],
    ],
    '^.*/marketing/promotion/profile.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller\BackendController:viewMarketingPromotionProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROMOTION,
            ],
        ],
    ],
    '^.*/marketing/event/list.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller\BackendController:viewMarketingEventList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::EVENT,
            ],
        ],
    ],
    '^.*/marketing/event/create.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller\BackendController:viewMarketingEventCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::EVENT,
            ],
        ],
    ],
    '^.*/marketing/event/profile.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller\BackendController:viewMarketingEventProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::EVENT,
            ],
        ],
    ],
];
