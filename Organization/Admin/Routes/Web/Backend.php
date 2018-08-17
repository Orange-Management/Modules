<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Organization\Models\PermissionState;
use Modules\Organization\Controller;

return [
    '^.*/backend/organization/unit/list.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewUnitList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/backend/organization/unit/profile.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewUnitProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/backend/organization/unit/create.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewUnitCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/backend/organization/department/list.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewDepartmentList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/backend/organization/department/profile.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewDepartmentProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/backend/organization/department/create.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewDepartmentCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/backend/organization/position/list.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewPositionList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::POSITION,
            ],
        ],
    ],
    '^.*/backend/organization/position/profile.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewPositionProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::POSITION,
            ],
        ],
    ],
    '^.*/backend/organization/position/create.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewPositionCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::POSITION,
            ],
        ],
    ],
];
