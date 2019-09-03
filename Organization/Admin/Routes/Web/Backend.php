<?php declare(strict_types=1);

use Modules\Organization\Controller\BackendController;
use Modules\Organization\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/organization/organigram.*$' => [
        [
            'dest' => '\Modules\Organization\Controller\BackendController:viewOrganigram',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ORGANIGRAM,
            ],
        ],
    ],
    '^.*/organization/unit/list.*$' => [
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
    '^.*/organization/unit/profile.*$' => [
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
    '^.*/organization/unit/create.*$' => [
        [
            'dest' => '\Modules\Media\Controller\BackendController::setUpFileUploader',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::UNIT,
            ],
        ],
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
    '^.*/organization/department/list.*$' => [
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
    '^.*/organization/department/profile.*$' => [
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
    '^.*/organization/department/create.*$' => [
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
    '^.*/organization/position/list.*$' => [
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
    '^.*/organization/position/profile.*$' => [
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
    '^.*/organization/position/create.*$' => [
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
