<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\News\Models\PermissionState;
use Modules\News\Controller\BackendController;

return [
    '^.*/backend/news/dashboard.*$' => [
        [
            'dest' => '\Modules\News\Controller\BackendController:viewNewsDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::NEWS,
            ],
        ],
    ],
    '^.*/backend/news/article.*$' => [
        [
            'dest' => '\Modules\News\Controller\BackendController:viewNewsArticle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::NEWS,
            ],
        ],
    ],
    '^.*/backend/news/archive.*$' => [
        [
            'dest' => '\Modules\News\Controller\BackendController:viewNewsArchive',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::NEWS,
            ],
        ],
    ],
    '^.*/backend/news/create.*$' => [
        [
            'dest' => '\Modules\Editor\Controller\BackendController:setUpEditorEditor',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::NEWS,
            ],
        ],
        [
            'dest' => '\Modules\News\Controller\BackendController:viewNewsCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::NEWS,
            ],
        ],
    ],
];
