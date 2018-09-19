<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Profile\Models\PermissionState;
use Modules\Profile\Controller\ApiController;

return [
    '^.*/api/profile.*$' => [
        [
            'dest' => '\Modules\Profile\Controller\ApiController:apiProfileCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PROFILE,
            ],
        ],
    ],
];