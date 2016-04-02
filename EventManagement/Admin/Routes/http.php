<?php

return [
    '^.*/backend/eventmanagement/list.*$' => [
        [
            'dest' => '\Modules\EventManagement\Controller:viewEventManagementList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/eventmanagement/create.*$' => [
        [
            'dest' => '\Modules\EventManagement\Controller:viewEventManagementCreate', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/eventmanagement/profile.*$' => [
        [
            'dest' => '\Modules\EventManagement\Controller:viewEventManagementProfile', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
