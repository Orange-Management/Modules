<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Editor\Models\PermissionState;
use Modules\Editor\Controller;

return [
    '^.*/backend/editor/create.*$' => [
        [
            'dest' => '\Modules\Editor\Controller:setUpEditorEditor',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DOC,
            ],
        ],
        [
            'dest' => '\Modules\Editor\Controller:viewEditorCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DOC,
            ],
        ],
    ],
    '^.*/backend/editor/list.*$' => [
        [
            'dest' => '\Modules\Editor\Controller:viewEditorList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DOC,
            ],
        ],
    ],
    '^.*/backend/editor/single.*$' => [
        [
            'dest' => '\Modules\Editor\Controller:viewEditorSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DOC,
            ],
        ],
    ],
];
