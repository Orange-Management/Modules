<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\CostObjectAccounting\Models\PermissionState;
use Modules\CostObjectAccounting\Controller;

return [
    '^.*/backend/accounting/costobject/list.*$' => [
        [
            'dest' => '\Modules\CostObjectAccounting\Controller:viewCostObjectList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COST_OBJECT,
            ],
        ],
    ],
    '^.*/backend/accounting/costobject/create.*$' => [
        [
            'dest' => '\Modules\CostObjectAccounting\Controller:viewCostObjectCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::COST_OBJECT,
            ],
        ],
    ],
    '^.*/backend/accounting/costobject/profile.*$' => [
        [
            'dest' => '\Modules\CostObjectAccounting\Controller:viewCostObjectProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COST_OBJECT,
            ],
        ],
    ],
];
