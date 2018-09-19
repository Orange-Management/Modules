<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Marketing\Models\PermissionState;
use Modules\Marketing\Controller\BackendController;

return [
    '^.*/backend/marketing/promotion/list.*$' => [
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
    '^.*/backend/marketing/promotion/create.*$' => [
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
    '^.*/backend/marketing/promotion/profile.*$' => [
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
    '^.*/backend/marketing/event/list.*$' => [
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
    '^.*/backend/marketing/event/create.*$' => [
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
    '^.*/backend/marketing/event/profile.*$' => [
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
