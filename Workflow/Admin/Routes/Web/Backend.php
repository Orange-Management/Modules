<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Workflow\Models\PermissionState;
use Modules\Workflow\Controller\BackendController;

return [
    '^.*/backend/workflow/template/list.*$' => [
        [
            'dest' => '\Modules\Workflow\Controller\BackendController:viewWorkflowTemplates',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/backend/workflow/template/single.*$' => [
        [
            'dest' => '\Modules\Workflow\Controller\BackendController:viewWorkflowTemplate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/backend/workflow/template/create.*$' => [
        [
            'dest' => '\Modules\Workflow\Controller\BackendController:viewWorkflowTemplateCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/backend/workflow/dashboard.*$' => [
        [
            'dest' => '\Modules\Workflow\Controller\BackendController:viewWorkflowDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WORKFLOW,
            ],
        ],
    ],
    '^.*/backend/workflow/single.*$' => [
        [
            'dest' => '\Modules\Workflow\Controller\BackendController:viewWorkflowSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WORKFLOW,
            ],
        ],
    ],
];
