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
    ],
];
