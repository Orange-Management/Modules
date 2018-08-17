<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\AccountsReceivable\Models\PermissionState;
use Modules\AccountsReceivable\Controller;

return [
    '^.*/backend/accounting/receivable/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/create.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/profile.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/outstanding.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorOutstanding',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/age.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorAge',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/receivable.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorPayable',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/dun/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorDunList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/dso/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewDebitorDsoList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DSO,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/journal/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewJournalList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/entries.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewEntriesList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/analyze.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller:viewAnalyzeDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
];
