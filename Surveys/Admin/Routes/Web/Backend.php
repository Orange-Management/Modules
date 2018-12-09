<?php

use Modules\Surveys\Controller\BackendController;
use Modules\Surveys\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/survey/list.*$' => [
        [
            'dest' => '\Modules\Surveys\Controller\BackendController:viewSurveysList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SURVEY,
            ],
        ],
    ],
    '^.*/backend/survey/create.*$' => [
        [
            'dest' => '\Modules\Surveys\Controller\BackendController:viewSurveysCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SURVEY,
            ],
        ],
    ],
    '^.*/backend/survey/profile.*$' => [
        [
            'dest' => '\Modules\Surveys\Controller\BackendController:viewSurveysProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SURVEY,
            ],
        ],
    ],
];
