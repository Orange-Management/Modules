<?php

use Modules\Kanban\Controller\BackendController;
use Modules\Kanban\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/kanban.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller\BackendController:setupStyles',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::KANBAN,
            ],
        ],
    ],
    '^.*/backend/kanban/dashboard.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller\BackendController:viewKanbanDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::KANBAN,
            ],
        ],
    ],
    '^.*/backend/kanban/archive.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller\BackendController:viewKanbanArchive',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::KANBAN,
            ],
        ],
    ],
    '^.*/backend/kanban/board.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller\BackendController:viewKanbanBoard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::BOARD,
            ],
        ],
    ],
    '^.*/backend/kanban/card.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller\BackendController:viewKanbanCard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CARD,
            ],
        ],
    ],
    '^.*/backend/kanban/create.*$' => [
        [
            'dest' => '\Modules\Kanban\Controller\BackendController:viewKanbanBoardCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::KANBAN,
            ],
        ],
    ],
];
