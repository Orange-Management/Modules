<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Tasks\Models\PermissionState;
use Modules\Tasks\Controller\ApiController;

return [
    '^.*/api/task(\?.*|$)' => [
        [
            'dest' => '\Modules\Tasks\Controller\ApiController:apiTaskCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TASK,
            ],
        ],
        [
            'dest' => '\Modules\Tasks\Controller\ApiController:apiTaskSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::TASK,
            ],
        ],
        [
            'dest' => '\Modules\Tasks\Controller\ApiController:apiTaskGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TASK,
            ],
        ],
    ],
    '^.*/api/task/element.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller\ApiController:apiTaskElementCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ELEMENT,
            ],
        ],
        [
            'dest' => '\Modules\Tasks\Controller\ApiController:apiTaskElementSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::ELEMENT,
            ],
        ],
        [
            'dest' => '\Modules\Tasks\Controller\ApiController:apiTaskElementGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ELEMENT,
            ],
        ],
    ],
];
