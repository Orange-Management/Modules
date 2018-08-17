<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\News\Models\PermissionState;
use Modules\News\Controller;

return [
    '^.*/backend/news/dashboard.*$' => [
        [
            'dest' => '\Modules\News\Controller:viewNewsDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::NEWS,
            ],
        ],
    ],
    '^.*/backend/news/article.*$' => [
        [
            'dest' => '\Modules\News\Controller:viewNewsArticle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::NEWS,
            ],
        ],
    ],
    '^.*/backend/news/archive.*$' => [
        [
            'dest' => '\Modules\News\Controller:viewNewsArchive',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::NEWS,
            ],
        ],
    ],
    '^.*/backend/news/create.*$' => [
        [
            'dest' => '\Modules\Editor\Controller:setUpEditorEditor',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::NEWS,
            ],
        ],
        [
            'dest' => '\Modules\News\Controller:viewNewsCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::NEWS,
            ],
        ],
    ],
];
