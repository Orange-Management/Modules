<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Editor\Models\PermissionState;
use Modules\Editor\Controller\ApiController;

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
    ],
];
