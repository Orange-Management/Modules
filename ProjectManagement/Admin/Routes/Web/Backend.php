<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\ProjectManagement\Models\PermissionState;
use Modules\ProjectManagement\Controller;

return [
    '^.*/backend/projectmanagement/list.*$' => [
        [
            'dest' => '\Modules\ProjectManagement\Controller:viewProjectManagementList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
    '^.*/backend/projectmanagement/create.*$' => [
        [
            'dest' => '\Modules\ProjectManagement\Controller:viewProjectManagementCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
    '^.*/backend/projectmanagement/profile.*$' => [
        [
            'dest' => '\Modules\ProjectManagement\Controller:viewProjectManagementProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
];
