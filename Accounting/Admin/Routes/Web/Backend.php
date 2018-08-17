<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Accounting\Models\PermissionState;
use Modules\Accounting\Controller;

return [
    '^.*/backend/accounting/personal/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewPersonalEntries',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PERSONAL,
            ],
        ],
    ],
    '^.*/backend/accounting/impersonal/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewImpersonalEntries',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::IMPERSONAL,
            ],
        ],
    ],
    '^.*/backend/accounting/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewEntries',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ENTRY,
            ],
        ],
    ],
    '^.*/backend/accounting/impersonal/journal/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewJournalList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::JOURNAL,
            ],
        ],
    ],
    '^.*/backend/accounting/stack/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewStackList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STACK,
            ],
        ],
    ],
    '^.*/backend/accounting/stack/entries.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewStackEntries',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STACK,
            ],
        ],
    ],
    '^.*/backend/accounting/stack/archive/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewStackArchiveList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STACK,
            ],
        ],
    ],
    '^.*/backend/accounting/stack/create.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewStackCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::STACK,
            ],
        ],
    ],
    '^.*/backend/accounting/stack/predefined/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewStackPredefinedList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STACK,
            ],
        ],
    ],
    '^.*/backend/accounting/gl/list.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewGLList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::GL,
            ],
        ],
    ],
    '^.*/backend/accounting/gl/create.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewGLCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::GL,
            ],
        ],
    ],
    '^.*/backend/accounting/gl/profile.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewGLProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::GL,
            ],
        ],
    ],
    '^.*/api/accounting/dun/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewCostCenterProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COST_CENTER,
            ],
        ],
    ],
    '^.*/api/accounting/statement/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewCostCenterProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/api/accounting/balances/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewCostCenterProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
    '^.*/api/accounting/accountform/print.*$' => [
        [
            'dest' => '\Modules\Accounting\Controller:viewCostCenterProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ACCOUNT,
            ],
        ],
    ],
];
