<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\ResearchDevelopment\Models\PermissionState;
use Modules\ResearchDevelopment\Controller\BackendController;

return [
    '^.*/backend/rnd/list.*$' => [
        [
            'dest' => '\Modules\ResearchDevelopment\Controller\BackendController:viewProjectList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
    '^.*/backend/rnd/create.*$' => [
        [
            'dest' => '\Modules\ResearchDevelopment\Controller\BackendController:viewProjectCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
];
