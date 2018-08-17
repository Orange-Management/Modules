<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Surveys\Models\PermissionState;
use Modules\Surveys\Controller;

return [
    '^.*/backend/survey/list.*$' => [
        [
            'dest' => '\Modules\Surveys\Controller:viewSurveysList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SURVEY,
            ],
        ],
    ],
    '^.*/backend/survey/create.*$' => [
        [
            'dest' => '\Modules\Surveys\Controller:viewSurveysCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SURVEY,
            ],
        ],
    ],
    '^.*/backend/survey/profile.*$' => [
        [
            'dest' => '\Modules\Surveys\Controller:viewSurveysProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SURVEY,
            ],
        ],
    ],
];
