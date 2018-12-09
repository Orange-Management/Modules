<?php

use Modules\Knowledgebase\Controller\BackendController;
use Modules\Knowledgebase\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/wiki.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller\BackendController:setUpBackend',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WIKI,
            ],
        ],
    ],
    '^.*/backend/wiki/dashboard.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller\BackendController:viewKnowledgebaseDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WIKI,
            ],
        ],
    ],
    '^.*/backend/wiki/category/list.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller\BackendController:viewKnowledgebaseCategoryList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CATEGORY,
            ],
        ],
    ],
    '^.*/backend/wiki/category/single.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller\BackendController:viewKnowledgebaseCategory',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CATEGORY,
            ],
        ],
    ],
    '^.*/backend/wiki/category/create.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller\BackendController:viewKnowledgebaseCategoryCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::CATEGORY,
            ],
        ],
    ],
    '^.*/backend/wiki/doc/single.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller\BackendController:viewKnowledgebaseDoc',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WIKI,
            ],
        ],
    ],
    '^.*/backend/wiki/doc/create.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller\BackendController:viewKnowledgebaseDocCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::WIKI,
            ],
        ],
    ],
    '^.*/backend/wiki/doc/list.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller\BackendController:viewKnowledgebaseDocList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WIKI,
            ],
        ],
    ],
];
