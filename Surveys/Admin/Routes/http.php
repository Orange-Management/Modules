<?php

$httpRoutes = [
    '^.*/backend/survey/list.*$' => [
        [
            'dest' => '\Modules\Surveys\Controller:viewSurveysList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/survey/create.*$' => [
        [
            'dest' => '\Modules\Surveys\Controller:viewSurveysCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/survey/profile.*$' => [
        [
            'dest' => '\Modules\Surveys\Controller:viewSurveysProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
