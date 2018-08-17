<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Media\Models\PermissionState;
use Modules\Media\Controller;

return [
    '^.*/api/media/collection.*$' => [
        [
            'dest' => '\Modules\Media\Controller:apiCollectionCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::COLLECTION,
            ],
        ],
    ],
    '^.*/api/media$' => [
        [
            'dest' => '\Modules\Media\Controller:apiMediaUpload',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::MEDIA,
            ],
        ],
    ],
    '^.*/api/media/create.*$' => [
        [
            'dest' => '\Modules\Media\Controller:apiMediaCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::MEDIA,
            ],
        ],
    ],
];
