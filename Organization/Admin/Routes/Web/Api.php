<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Organization\Models\PermissionState;
use Modules\Organization\Controller;

return [
    '^.*/api/organization/position.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiPositionCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::POSITION,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiPositionGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::POSITION,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiPositionSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::POSITION,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiPositionDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::POSITION,
            ],
        ],
    ],
    '^.*/api/organization/department.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiDepartmentCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiDepartmentGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiDepartmentSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiDepartmentDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/api/organization/unit.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiUnitCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::UNIT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiUnitGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiUnitSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::UNIT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiUnitDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],

    '^.*/api/organization/find/unit.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiUnitFind',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/api/organization/find/department.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiDepartmentFind',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/api/organization/find/position.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiPositionFind',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::POSITION,
            ],
        ],
    ],
];
