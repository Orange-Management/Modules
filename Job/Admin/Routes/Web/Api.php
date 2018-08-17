<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Job\Models\PermissionState;
use Modules\Job\Controller;

return [
    '^.*/backend/admin/job.*$' => [
        [
            'dest' => '\Modules\Job\Controller:apiJobCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::JOB,
            ],
        ],
    ],
];
