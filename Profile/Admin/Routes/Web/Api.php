<?php

use Modules\Profile\Controller\ApiController;
use Modules\Profile\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/profile.*$' => [
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