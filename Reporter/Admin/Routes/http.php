<?php

$httpRoutes = [
    '^.*/backend/reporter/template/create.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:setUpFileUploader', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::NULL,
        ],
        [
            'dest' => '\Modules\Reporter\Controller:viewTemplateCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/reporter/report/create.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:setUpFileUploader', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::NULL,
        ],
        [
            'dest' => '\Modules\Reporter\Controller:viewReportCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/reporter/list.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:viewTemplateList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/reporter/report/view.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:viewReporterReport', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/api/reporter/report/export.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:viewReporterExport', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/api/reporter/report/template.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:apiCreateTemplate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/api/reporter/report/report.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:apiCreateReport', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
