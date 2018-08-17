<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\AccountsPayable\Models\PermissionState;
use Modules\AccountsPayable\Controller;

return [
    '^.*/backend/accounting/payable/list.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/payable/create.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/payable/profile.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/payable/outstanding.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorOutstanding',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/payable/age.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorAge',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/payable/payable.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewCreditorPayable',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/payable/journal/list.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewJournalList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/payable/entries.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewEntriesList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
    '^.*/backend/accounting/payable/analyze.*$' => [
        [
            'dest' => '\Modules\AccountsPayable\Controller:viewAnalyzeDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::PAYABLE,
            ],
        ],
    ],
];
