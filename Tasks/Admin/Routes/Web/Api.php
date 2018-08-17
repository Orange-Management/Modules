<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Tasks\Models\PermissionState;
use Modules\Tasks\Controller;

return [
    '^.*/api/task(\?.*|$)' => [
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TASK,
            ],
        ],
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::TASK,
            ],
        ],
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TASK,
            ],
        ],
    ],
    '^.*/api/task/element.*$' => [
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskElementCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::ELEMENT,
            ],
        ],
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskElementSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::ELEMENT,
            ],
        ],
        [
            'dest' => '\Modules\Tasks\Controller:apiTaskElementGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ELEMENT,
            ],
        ],
    ],
];
