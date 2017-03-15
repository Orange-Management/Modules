<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/kanban/dashbaord.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller:viewKanbanDashboard',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/kanban/board.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller:viewKanbanBoard',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/kanban/create.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller:viewKanbanCreate',
            'verb' => RouteVerb::GET,
        ],
    ],
];
