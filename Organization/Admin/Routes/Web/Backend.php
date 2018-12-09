<?php

use Modules\Organization\Controller\BackendController;
use Modules\Organization\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/organization/unit/list.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\BackendController:viewUnitList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/backend/organization/unit/profile.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\BackendController:viewUnitProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/backend/organization/unit/create.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\BackendController:viewUnitCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/backend/organization/department/list.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\BackendController:viewDepartmentList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/backend/organization/department/profile.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\BackendController:viewDepartmentProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/backend/organization/department/create.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\BackendController:viewDepartmentCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/backend/organization/position/list.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\BackendController:viewPositionList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::POSITION,
            ],
        ],
    ],
    '^.*/backend/organization/position/profile.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\BackendController:viewPositionProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::POSITION,
            ],
        ],
    ],
    '^.*/backend/organization/position/create.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\BackendController:viewPositionCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::POSITION,
            ],
        ],
    ],
];
