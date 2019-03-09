<?php

use Modules\Kanban\Controller\BackendController;
use Modules\Kanban\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/kanban.*$' => [
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
    '^.*/kanban/dashboard.*$' => [
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
    '^.*/kanban/archive.*$' => [
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
    '^.*/kanban/board.*$' => [
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
    '^.*/kanban/card.*$' => [
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
    '^.*/kanban/create.*$' => [
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
