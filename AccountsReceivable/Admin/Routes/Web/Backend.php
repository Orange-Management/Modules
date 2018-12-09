<?php

use Modules\AccountsReceivable\Controller\BackendController;
use Modules\AccountsReceivable\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/accounting/receivable/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewDebitorList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/create.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewDebitorCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/profile.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewDebitorProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/outstanding.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewDebitorOutstanding',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/age.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewDebitorAge',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/receivable.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewDebitorPayable',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/dun/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewDebitorDunList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/dso/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewDebitorDsoList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DSO,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/journal/list.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewJournalList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/entries.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewEntriesList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/receivable/analyze.*$' => [
        [
            'dest' => '\Modules\AccountsReceivable\Controller\BackendController:viewAnalyzeDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::RECEIVABLE,
            ],
        ],
    ],
];
