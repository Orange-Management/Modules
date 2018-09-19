<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Job\Models\PermissionState;
use Modules\Job\Controller\BackendController;

return [
    '^.*/backend/admin/job/list.*$' => [
        [
            'dest' => '\Modules\Job\Controller\BackendController:viewJobList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::JOB,
            ],
        ],
    ],
    '^.*/backend/admin/job/single.*$' => [
        [
            'dest' => '\Modules\Job\Controller\BackendController:viewJob',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::JOB,
            ],
        ],
    ],
    '^.*/backend/admin/job/create.*$' => [
        [
            'dest' => '\Modules\Job\Controller\BackendController:viewJobCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::JOB,
            ],
        ],
    ],
];
