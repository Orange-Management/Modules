<?php declare(strict_types=1);

use Modules\Organization\Controller\ApiController;
use Modules\Organization\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/organization/position.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiPositionCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::POSITION,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiPositionGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::POSITION,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiPositionSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::POSITION,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiPositionDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::POSITION,
            ],
        ],
    ],
    '^.*/organization/department.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiDepartmentCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiDepartmentGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiDepartmentSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiDepartmentDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/organization/unit.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiUnitCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::UNIT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiUnitGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiUnitSet',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::UNIT,
            ],
        ],
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiUnitDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],

    '^.*/organization/find/unit.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiUnitFind',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/organization/find/department.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiDepartmentFind',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/organization/find/position.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\ApiController:apiPositionFind',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::POSITION,
            ],
        ],
    ],
];
