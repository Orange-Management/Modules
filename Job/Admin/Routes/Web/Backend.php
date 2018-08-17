<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Job\Models\PermissionState;
use Modules\Job\Controller;

return [
    '^.*/backend/admin/job/list.*$' => [
        [
            'dest' => '\Modules\Job\Controller:viewJobList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::JOB,
            ],
        ],
    ],
    '^.*/backend/admin/job/single.*$' => [
        [
            'dest' => '\Modules\Job\Controller:viewJob',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::JOB,
            ],
        ],
    ],
    '^.*/backend/admin/job/create.*$' => [
        [
            'dest' => '\Modules\Job\Controller:viewJobCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::JOB,
            ],
        ],
    ],
];
