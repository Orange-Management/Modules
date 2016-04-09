<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/reporter/template/create.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:setUpFileUploader', 
            'verb' => RouteVerb::GET,
        ],
        [
            'dest' => '\Modules\Reporter\Controller:viewTemplateCreate', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/reporter/report/create.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:setUpFileUploader', 
            'verb' => RouteVerb::GET,
        ],
        [
            'dest' => '\Modules\Reporter\Controller:viewReportCreate', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/reporter/list.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:viewTemplateList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/reporter/report/view.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:viewReporterReport', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/api/reporter/report/export.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:viewReporterExport', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/api/reporter/report/template.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:apiCreateTemplate', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/api/reporter/report/report.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:apiCreateReport', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
