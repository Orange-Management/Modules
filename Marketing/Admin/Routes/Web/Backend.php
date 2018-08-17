<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Marketing\Models\PermissionState;
use Modules\Marketing\Controller;

return [
    '^.*/backend/marketing/promotion/list.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller:viewMarketingPromotionList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROMOTION,
            ],
        ],
    ],
    '^.*/backend/marketing/promotion/create.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller:viewMarketingPromotionCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PROMOTION,
            ],
        ],
    ],
    '^.*/backend/marketing/promotion/profile.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller:viewMarketingPromotionProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROMOTION,
            ],
        ],
    ],
    '^.*/backend/marketing/event/list.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller:viewMarketingEventList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::EVENT,
            ],
        ],
    ],
    '^.*/backend/marketing/event/create.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller:viewMarketingEventCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::EVENT,
            ],
        ],
    ],
    '^.*/backend/marketing/event/profile.*$' => [
        [
            'dest' => '\Modules\Marketing\Controller:viewMarketingEventProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::EVENT,
            ],
        ],
    ],
];
