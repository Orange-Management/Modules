<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\EventManagement\Models\PermissionState;
use Modules\EventManagement\Controller;

return [
    '^.*/backend/eventmanagement/list.*$' => [
        [
            'dest' => '\Modules\EventManagement\Controller:viewEventManagementList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::EVENT,
            ],
        ],
    ],
    '^.*/backend/eventmanagement/create.*$' => [
        [
            'dest' => '\Modules\EventManagement\Controller:viewEventManagementCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::EVENT,
            ],
        ],
    ],
    '^.*/backend/eventmanagement/profile.*$' => [
        [
            'dest' => '\Modules\EventManagement\Controller:viewEventManagementProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::EVENT,
            ],
        ],
    ],
];
