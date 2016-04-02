<?php

return [
    '^.*/backend/calendar/dashboard.*$' => [
        [
            'dest' => '\Modules\Calendar\Controller:viewCalendarDashboard', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
