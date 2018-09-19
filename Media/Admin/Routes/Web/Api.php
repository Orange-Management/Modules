<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Media\Models\PermissionState;
use Modules\Media\Controller\ApiController;

return [
    '^.*/api/media/collection.*$' => [
        [
            'dest' => '\Modules\Media\Controller\ApiController:apiCollectionCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::COLLECTION,
            ],
        ],
    ],
    '^.*/api/media$' => [
        [
            'dest' => '\Modules\Media\Controller\ApiController:apiMediaUpload',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::MEDIA,
            ],
        ],
    ],
    '^.*/api/media/create.*$' => [
        [
            'dest' => '\Modules\Media\Controller\ApiController:apiMediaCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::MEDIA,
            ],
        ],
    ],
];
