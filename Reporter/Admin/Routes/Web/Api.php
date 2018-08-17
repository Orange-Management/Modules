<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Reporter\Models\PermissionState;
use Modules\Reporter\Controller;

return [
    '^.*/api/reporter/report/export.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:apiReporterExport',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::REPORT,
            ],
        ],
    ],
    '^.*/api/reporter/report/template.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:apiTemplateCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/api/reporter/report/report.*$' => [
        [
            'dest' => '\Modules\Reporter\Controller:apiReportCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::REPORT,
            ],
        ],
    ],
];
