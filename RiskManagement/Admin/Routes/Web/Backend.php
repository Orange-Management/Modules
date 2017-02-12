<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/controlling/riskmanagement/cockpit.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCockpit', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/risk/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/risk/create.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCreate', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/cause/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCauseList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/solution/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskSolutionList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/unit/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskUnitList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/department/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskDepartmentList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/category/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCategoryList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/project/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskProjectList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/process/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskProcessList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/settings/dashboard.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskSettings', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
