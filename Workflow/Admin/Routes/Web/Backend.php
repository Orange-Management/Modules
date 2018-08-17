<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Workflow\Models\PermissionState;
use Modules\Workflow\Controller;

return [
    '^.*/backend/workflow/template/list.*$' => [
        [
            'dest' => '\Modules\Workflow\Controller:viewWorkflowTemplates',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/backend/workflow/template/single.*$' => [
        [
            'dest' => '\Modules\Workflow\Controller:viewWorkflowTemplate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/backend/workflow/template/create.*$' => [
        [
            'dest' => '\Modules\Workflow\Controller:viewWorkflowTemplateCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::TEMPLATE,
            ],
        ],
    ],
    '^.*/backend/workflow/dashboard.*$' => [
        [
            'dest' => '\Modules\Workflow\Controller:viewWorkflowDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WORKFLOW,
            ],
        ],
    ],
    '^.*/backend/workflow/single.*$' => [
        [
            'dest' => '\Modules\Workflow\Controller:viewWorkflowSingle',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::WORKFLOW,
            ],
        ],
    ],
];
