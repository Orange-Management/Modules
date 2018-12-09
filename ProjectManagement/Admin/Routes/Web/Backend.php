<?php

use Modules\ProjectManagement\Controller\BackendController;
use Modules\ProjectManagement\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/projectmanagement/list.*$' => [
        [
            'dest' => '\Modules\ProjectManagement\Controller\BackendController:viewProjectManagementList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
    '^.*/backend/projectmanagement/create.*$' => [
        [
            'dest' => '\Modules\ProjectManagement\Controller\BackendController:viewProjectManagementCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
    '^.*/backend/projectmanagement/profile.*$' => [
        [
            'dest' => '\Modules\ProjectManagement\Controller\BackendController:viewProjectManagementProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
];
