<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Editor\Models\PermissionState;
use Modules\Editor\Controller\BackendController;

return [
    '^.*/backend/editor/create.*$' => [
        [
            'dest' => '\Modules\Editor\Controller\BackendController:setUpEditorEditor',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DOC,
            ],
        ],
        [
            'dest' => '\Modules\Editor\Controller\BackendController:viewEditorCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DOC,
            ],
        ],
    ],
    '^.*/backend/editor/list.*$' => [
        [
            'dest' => '\Modules\Editor\Controller\BackendController:viewEditorList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DOC,
            ],
        ],
    ],
    '^.*/backend/editor/single.*$' => [
        [
            'dest' => '\Modules\Editor\Controller\BackendController:viewEditorSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DOC,
            ],
        ],
    ],
];
