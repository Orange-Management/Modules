<?php declare(strict_types=1);

use Modules\Helper\Controller\BackendController;
use Modules\Helper\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/helper/template/create.*$' => [
        [
            'dest' => '\Modules\Media\Controller\BackendController::setUpFileUploader',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
        [
            'dest' => '\Modules\Helper\Controller\BackendController:viewTemplateCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/helper/report/create.*$' => [
        [
            'dest' => '\Modules\Media\Controller\BackendController::setUpFileUploader',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::REPORT,
            ],
        ],
        [
            'dest' => '\Modules\Helper\Controller\BackendController:viewReportCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::REPORT,
            ],
        ],
    ],
    '^.*/helper/list.*$' => [
        [
            'dest' => '\Modules\Helper\Controller\BackendController:viewTemplateList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::REPORT,
            ],
        ],
    ],
    '^.*/helper/report/view.*$' => [
        [
            'dest' => '\Modules\Helper\Controller\BackendController:viewHelperReport',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::REPORT,
            ],
        ],
    ],
];
