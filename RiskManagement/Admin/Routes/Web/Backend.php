<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\RiskManagement\Models\PermissionState;
use Modules\RiskManagement\Controller\BackendController;

return [
    '^.*/backend/riskmanagement/cockpit.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskCockpit',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COCKPIT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/risk/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RISK,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/risk/create.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::RISK,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/risk/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RISK,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/cause/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskCauseList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CAUSE,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/cause/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskCauseSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CAUSE,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/solution/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskSolutionList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SOLUTION,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/solution/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskSolutionSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SOLUTION,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/unit/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskUnitList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/unit/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskUnitSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/department/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskDepartmentList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/department/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskDepartmentSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/category/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskCategoryList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CATEGORY,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/category/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskCategorySingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CATEGORY,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/project/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskProjectList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/project/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskProjectSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/process/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskProcessList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROCESS,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/process/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskProcessSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROCESS,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/settings/dashboard.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller\BackendController:viewRiskSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SETTINGS,
            ],
        ],
    ],
];
