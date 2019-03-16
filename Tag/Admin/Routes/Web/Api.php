<?php

use Modules\Tag\Controller\ApiController;
use Modules\Tag\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/tag.*$' => [
        [
            'dest' => '\Modules\Tag\Controller\ApiController:apiTagCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TAG,
            ],
        ],
        [
            'dest' => '\Modules\Tag\Controller\ApiController:apiTagUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::Tag,
            ],
        ],
        [
            'dest' => '\Modules\Tag\Controller\ApiController:apiTagDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::TAG,
            ],
        ],
    ],
];