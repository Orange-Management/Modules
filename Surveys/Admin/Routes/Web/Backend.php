<?php declare(strict_types=1);

use Modules\Surveys\Controller\BackendController;
use Modules\Surveys\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/survey/list.*$' => [
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
    '^.*/survey/create.*$' => [
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
    '^.*/survey/profile.*$' => [
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
