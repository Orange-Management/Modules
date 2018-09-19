<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Job\Models\PermissionState;
use Modules\Job\Controller\ApiController;

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
