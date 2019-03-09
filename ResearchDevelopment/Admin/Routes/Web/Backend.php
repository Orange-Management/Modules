<?php

use Modules\ResearchDevelopment\Controller\BackendController;
use Modules\ResearchDevelopment\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/rnd/list.*$' => [
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
    '^.*/rnd/create.*$' => [
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
