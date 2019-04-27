<?php declare(strict_types=1);

use Modules\ProjectManagement\Controller\BackendController;
use Modules\ProjectManagement\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/projectmanagement/list.*$' => [
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
    '^.*/projectmanagement/create.*$' => [
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
    '^.*/projectmanagement/profile.*$' => [
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
