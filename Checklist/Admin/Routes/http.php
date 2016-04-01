<?php

$httpRoutes = [
    '^.*/backend/checklist/list.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller:viewChecklistList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/checklist/template/list.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller:viewChecklistTemplateList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/checklist/template/create.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller:viewChecklistTemplateCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/checklist/template/view.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller:viewChecklistTemplateView', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
