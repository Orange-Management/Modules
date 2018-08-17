<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Kanban\Models\PermissionState;
use Modules\Kanban\Controller;

return [
    '^.*/backend/kanban.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller:setupStyles',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::KANBAN,
            ],
        ],
    ],
    '^.*/backend/kanban/dashboard.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller:viewKanbanDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::KANBAN,
            ],
        ],
    ],
    '^.*/backend/kanban/archive.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller:viewKanbanArchive',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::KANBAN,
            ],
        ],
    ],
    '^.*/backend/kanban/board.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller:viewKanbanBoard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::BOARD,
            ],
        ],
    ],
    '^.*/backend/kanban/card.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller:viewKanbanCard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CARD,
            ],
        ],
    ],
    '^.*/backend/kanban/create.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller:viewKanbanBoardCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::KANBAN,
            ],
        ],
    ],
];
