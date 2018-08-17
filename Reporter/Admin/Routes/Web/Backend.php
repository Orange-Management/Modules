<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Reporter\Models\PermissionState;
use Modules\Reporter\Controller;

return [
    '^.*/backend/reporter/template/create.*$' => [
        [
            'dest' => '\Modules\Media\Controller::setUpFileUploader',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
        [
            'dest' => '\Modules\Reporter\Controller:viewTemplateCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/backend/reporter/report/create.*$' => [
        [
            'dest' => '\Modules\Media\Controller::setUpFileUploader',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::REPORT,
            ],
        ],
        [
            'dest' => '\Modules\Reporter\Controller:viewReportCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::REPORT,
            ],
        ],
    ],
    '^.*/backend/reporter/list.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:viewTemplateList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::REPORT,
            ],
        ],
    ],
    '^.*/backend/reporter/report/view.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:viewReporterReport',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::REPORT,
            ],
        ],
    ],
];
