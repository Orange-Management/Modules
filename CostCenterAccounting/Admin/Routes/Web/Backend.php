<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\CostCenterAccounting\Models\PermissionState;
use Modules\CostCenterAccounting\Controller;

return [
    '^.*/backend/accounting/costcenter/list.*$' => [
        [
            'dest' => '\Modules\CostCenterAccounting\Controller:viewCostCenterList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COST_CENTER,
            ],
        ],
    ],
    '^.*/backend/accounting/costcenter/create.*$' => [
        [
            'dest' => '\Modules\CostCenterAccounting\Controller:viewCostCenterCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::COST_CENTER,
            ],
        ],
    ],
    '^.*/backend/accounting/costcenter/profile.*$' => [
        [
            'dest' => '\Modules\CostCenterAccounting\Controller:viewCostCenterProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COST_CENTER,
            ],
        ],
    ],
];
