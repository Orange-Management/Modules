<?php declare(strict_types=1);

use Modules\AccountsPayable\Controller\BackendController;
use Modules\AccountsPayable\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/accounting/payable/list.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller\BackendController:viewCreditorList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/accounting/payable/create.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller\BackendController:viewCreditorCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/accounting/payable/profile.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller\BackendController:viewCreditorProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/accounting/payable/outstanding.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller\BackendController:viewCreditorOutstanding',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/accounting/payable/age.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller\BackendController:viewCreditorAge',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/accounting/payable/payable.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller\BackendController:viewCreditorPayable',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/accounting/payable/journal/list.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller\BackendController:viewJournalList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/accounting/payable/entries.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller\BackendController:viewEntriesList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/accounting/payable/analyze.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller\BackendController:viewAnalyzeDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
];
