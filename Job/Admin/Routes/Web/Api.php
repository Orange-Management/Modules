<?php

use Modules\Job\Controller\ApiController;
use Modules\Job\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/admin/job.*$' => [
        [
            'dest' => '\Modules\Job\Controller\ApiController:apiJobCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::JOB,
            ],
        ],
    ],
];
