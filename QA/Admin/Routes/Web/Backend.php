<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\QA\Models\PermissionState;
use Modules\QA\Controller\BackendController;

return [
    '^.*/backend/qa.*$' => [
        [
            'dest' => '\Modules\QA\Controller\BackendController:setUpBackend',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::QA,
            ],
        ],
    ],
    '^.*/backend/qa/dashboard.*$' => [
        [
            'dest' => '\Modules\QA\Controller\BackendController:viewQADashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::QA,
            ],
        ],
    ],
    '^.*/backend/qa/badge/list.*$' => [
        [
            'dest' => '\Modules\QA\Controller\BackendController:viewQABadgeList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::BADGE,
            ],
        ],
    ],
    '^.*/backend/qa/badge/single.*$' => [
        [
            'dest' => '\Modules\QA\Controller\BackendController:viewQABadgeEdit',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::BADGE,
            ],
        ],
    ],
    '^.*/backend/qa/question.*$' => [
        [
            'dest' => '\Modules\QA\Controller\BackendController:viewQADoc',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::QUESTION,
            ],
        ],
    ],
    '^.*/backend/qa/question/create.*$' => [
        [
            'dest' => '\Modules\QA\Controller\BackendController:viewQAQuestionCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::QUESTION,
            ],
        ],
    ],
];
