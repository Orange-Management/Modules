<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\RiskManagement\Models\PermissionState;
use Modules\RiskManagement\Controller;

return [
    '^.*/backend/riskmanagement/cockpit.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCockpit',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COCKPIT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/risk/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RISK,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/risk/create.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::RISK,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/risk/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RISK,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/cause/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCauseList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CAUSE,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/cause/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCauseSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CAUSE,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/solution/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskSolutionList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SOLUTION,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/solution/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskSolutionSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SOLUTION,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/unit/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskUnitList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/unit/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskUnitSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::UNIT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/department/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskDepartmentList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/department/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskDepartmentSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DEPARTMENT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/category/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCategoryList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CATEGORY,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/category/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCategorySingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CATEGORY,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/project/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskProjectList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/project/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskProjectSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/process/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskProcessList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROCESS,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/process/single.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskProcessSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROCESS,
            ],
        ],
    ],
    '^.*/backend/riskmanagement/settings/dashboard.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SETTINGS,
            ],
        ],
    ],
];
