<?php

$httpRoutes = [
    '^.*/backend/controlling/riskmanagement/cockpit.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCockpit', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/risk/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/cause/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCauseList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/solution/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskSolutionList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/unit/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskUnitList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/department/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskDepartmentList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/category/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskCategoryList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/project/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskProjectList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/process/list.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskProcessList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/controlling/riskmanagement/settings/dashboard.*$' => [
        [
            'dest' => '\Modules\RiskManagement\Controller:viewRiskSettings', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
