<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\ResearchDevelopment\Models\PermissionState;
use Modules\ResearchDevelopment\Controller;

return [
    '^.*/backend/rnd/list.*$' => [
        [
            'dest' => '\Modules\ResearchDevelopment\Controller:viewProjectList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
    '^.*/backend/rnd/create.*$' => [
        [
            'dest' => '\Modules\ResearchDevelopment\Controller:viewProjectCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PROJECT,
            ],
        ],
    ],
];
