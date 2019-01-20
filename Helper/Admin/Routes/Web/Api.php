<?php

use Modules\Helper\Controller\ApiController;
use Modules\Helper\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/api/helper/report/export.*$' => [
        [
            'dest' => '\Modules\Helper\Controller\ApiController:apiHelperExport',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::REPORT,
            ],
        ],
    ],
    '^.*/api/helper/report/template.*$' => [
        [
            'dest' => '\Modules\Helper\Controller\ApiController:apiTemplateCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/api/helper/report/report.*$' => [
        [
            'dest' => '\Modules\Helper\Controller\ApiController:apiReportCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::REPORT,
            ],
        ],
    ],
];
