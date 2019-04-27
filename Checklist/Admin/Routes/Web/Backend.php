<?php declare(strict_types=1);

use Modules\Checklist\Controller\BackendController;
use Modules\Checklist\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/checklist/list.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller\BackendController:viewChecklistList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CHECKLIST,
            ],
        ],
    ],
    '^.*/checklist/template/list.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller\BackendController:viewChecklistTemplateList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/checklist/template/create.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller\BackendController:viewChecklistTemplateCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/checklist/template/view.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller\BackendController:viewChecklistTemplateView',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
];
