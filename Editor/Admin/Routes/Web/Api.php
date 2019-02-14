<?php

use Modules\Editor\Controller\ApiController;
use Modules\Editor\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/api/editor.*$' => [
        [
            'dest' => '\Modules\Editor\Controller\ApiController:apiEditorCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DOC,
            ],
        ],
        [
            'dest' => '\Modules\Editor\Controller\ApiController:apiEditorUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::DOC,
            ],
        ],
        [
            'dest' => '\Modules\Editor\Controller\ApiController:apiEditorGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DOC,
            ],
        ],
        [
            'dest' => '\Modules\Editor\Controller\ApiController:apiEditorDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::DOC,
            ],
        ],
    ],
];
