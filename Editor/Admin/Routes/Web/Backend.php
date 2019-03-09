<?php

use Modules\Editor\Controller\BackendController;
use Modules\Editor\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/editor/create.*$' => [
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
    '^.*/editor/list.*$' => [
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
    '^.*/editor/single.*$' => [
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
