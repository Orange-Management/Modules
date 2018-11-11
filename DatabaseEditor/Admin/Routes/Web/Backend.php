<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\DatabaseEditor\Models\PermissionState;
use Modules\DatabaseEditor\Controller\BackendController;

return [
    '^.*/backend/dbeditor/editor.*$' => [
        [
            'dest' => '\Modules\DatabaseEditor\Controller\BackendController:viewDatabaseEditorEditor',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DATABASE_EDITOR,
            ],
        ],
    ],
];
