<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Draw\Models\PermissionState;
use Modules\Draw\Controller\ApiController;

return [
    '^.*/api/draw.*$' => [
        [
            'dest' => '\Modules\Draw\ControllerApiController:apiDrawCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DRAW,
            ],
        ],
    ],
];
