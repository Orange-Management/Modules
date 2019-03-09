<?php

use Modules\QA\Controller\BackendController;
use Modules\QA\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/qa.*$' => [
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
    '^.*/qa/dashboard.*$' => [
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
    '^.*/qa/question.*$' => [
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
    '^.*/qa/question/create.*$' => [
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
