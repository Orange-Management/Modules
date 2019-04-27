<?php declare(strict_types=1);

use Modules\Accounting\Controller\BackendController;
use Modules\Accounting\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/accounting/personal/entries.*$' => [
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
    '^.*/accounting/impersonal/entries.*$' => [
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
    '^.*/accounting/entries.*$' => [
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
    '^.*/accounting/impersonal/journal/list.*$' => [
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
    '^.*/accounting/stack/list.*$' => [
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
    '^.*/accounting/stack/entries.*$' => [
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
    '^.*/accounting/stack/archive/list.*$' => [
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
    '^.*/accounting/stack/create.*$' => [
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
    '^.*/accounting/stack/predefined/list.*$' => [
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
    '^.*/accounting/gl/list.*$' => [
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
    '^.*/accounting/gl/create.*$' => [
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
    '^.*/accounting/gl/profile.*$' => [
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
    '^.*/accounting/dun/print.*$' => [
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
    '^.*/accounting/statement/print.*$' => [
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
    '^.*/accounting/balances/print.*$' => [
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
    '^.*/accounting/accountform/print.*$' => [
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
