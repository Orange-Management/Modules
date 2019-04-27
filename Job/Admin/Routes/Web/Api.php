<?php declare(strict_types=1);

use Modules\Job\Controller\ApiController;
use Modules\Job\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/admin/job.*$' => [
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
