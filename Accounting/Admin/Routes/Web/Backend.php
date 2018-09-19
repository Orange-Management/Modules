<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Accounting\Models\PermissionState;
use Modules\Accounting\Controller\BackendController;

return [
    '^.*/backend/accounting/personal/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewPersonalEntries',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PERSONAL,
            ],
        ],
    ],
    '^.*/backend/accounting/impersonal/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewImpersonalEntries',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::IMPERSONAL,
            ],
        ],
    ],
    '^.*/backend/accounting/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewEntries',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ENTRY,
            ],
        ],
    ],
    '^.*/backend/accounting/impersonal/journal/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewJournalList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::JOURNAL,
            ],
        ],
    ],
    '^.*/backend/accounting/stack/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewStackList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STACK,
            ],
        ],
    ],
    '^.*/backend/accounting/stack/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewStackEntries',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STACK,
            ],
        ],
    ],
    '^.*/backend/accounting/stack/archive/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewStackArchiveList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STACK,
            ],
        ],
    ],
    '^.*/backend/accounting/stack/create.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewStackCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::STACK,
            ],
        ],
    ],
    '^.*/backend/accounting/stack/predefined/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewStackPredefinedList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STACK,
            ],
        ],
    ],
    '^.*/backend/accounting/gl/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewGLList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::GL,
            ],
        ],
    ],
    '^.*/backend/accounting/gl/create.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewGLCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::GL,
            ],
        ],
    ],
    '^.*/backend/accounting/gl/profile.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewGLProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::GL,
            ],
        ],
    ],
    '^.*/api/accounting/dun/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewCostCenterProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COST_CENTER,
            ],
        ],
    ],
    '^.*/api/accounting/statement/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewCostCenterProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/api/accounting/balances/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewCostCenterProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/api/accounting/accountform/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller\BackendController:viewCostCenterProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
];
