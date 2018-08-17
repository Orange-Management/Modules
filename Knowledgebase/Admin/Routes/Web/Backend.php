<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Knowledgebase\Models\PermissionState;
use Modules\Knowledgebase\Controller;

return [
    '^.*/backend/wiki.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:setUpBackend',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WIKI,
            ],
        ],
    ],
    '^.*/backend/wiki/dashboard.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WIKI,
            ],
        ],
    ],
    '^.*/backend/wiki/category/list.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseCategoryList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CATEGORY,
            ],
        ],
    ],
    '^.*/backend/wiki/category/single.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseCategory',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CATEGORY,
            ],
        ],
    ],
    '^.*/backend/wiki/category/create.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseCategoryCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::CATEGORY,
            ],
        ],
    ],
    '^.*/backend/wiki/doc/single.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseDoc',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WIKI,
            ],
        ],
    ],
    '^.*/backend/wiki/doc/create.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseDocCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::WIKI,
            ],
        ],
    ],
    '^.*/backend/wiki/doc/list.*$' => [
        [
            'dest' => '\Modules\Knowledgebase\Controller:viewKnowledgebaseDocList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WIKI,
            ],
        ],
    ],
];
