<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Checklist\Models\PermissionState;
use Modules\Checklist\Controller;

return [
    '^.*/backend/checklist/list.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller:viewChecklistList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CHECKLIST,
            ],
        ],
    ],
    '^.*/backend/checklist/template/list.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller:viewChecklistTemplateList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/backend/checklist/template/create.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller:viewChecklistTemplateCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/backend/checklist/template/view.*$' => [
        [
            'dest' => '\Modules\Checklist\Controller:viewChecklistTemplateView',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
];
