<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Editor\Models\PermissionState;
use Modules\Editor\Controller;

return [
    '^.*/api/editor.*$' => [
        [
            'dest' => '\Modules\Editor\Controller:apiEditorCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DOC,
            ],
        ],
    ],
];
