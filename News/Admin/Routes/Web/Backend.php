<?php

use Modules\News\Controller\BackendController;
use Modules\News\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/news/dashboard.*$' => [
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
    '^.*/news/article.*$' => [
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
    '^.*/news/archive.*$' => [
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
    '^.*/news/create.*$' => [
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
