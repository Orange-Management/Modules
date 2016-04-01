<?php

$httpRoutes = [
    '^.*/backend/organization/unit/list.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewUnitList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/organization/unit/profile.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewUnitProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/organization/unit/create.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewUnitCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/organization/department/list.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewDepartmentList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/organization/department/profile.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewDepartmentProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/organization/department/create.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewDepartmentCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/organization/position/list.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewPositionList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/organization/position/profile.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewPositionProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/organization/position/create.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:viewPositionCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
