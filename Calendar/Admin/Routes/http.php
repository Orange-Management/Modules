<?php

$httpRoutes = [
    '^.*/backend/calendar/dashboard.*$' => [
        [
            'dest' => '\Modules\Calendar\Controller:viewCalendarDashboard', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
