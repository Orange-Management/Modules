<?php declare(strict_types=1);

use Modules\AccountsReceivable\Controller\BackendController;
use Modules\AccountsReceivable\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/accounting/receivable/list.*$' => [
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
    '^.*/accounting/receivable/create.*$' => [
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
    '^.*/accounting/receivable/profile.*$' => [
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
    '^.*/accounting/receivable/outstanding.*$' => [
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
    '^.*/accounting/receivable/age.*$' => [
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
    '^.*/accounting/receivable/receivable.*$' => [
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
    '^.*/accounting/receivable/dun/list.*$' => [
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
    '^.*/accounting/receivable/dso/list.*$' => [
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
    '^.*/accounting/receivable/journal/list.*$' => [
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
    '^.*/accounting/receivable/entries.*$' => [
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
    '^.*/accounting/receivable/analyze.*$' => [
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
