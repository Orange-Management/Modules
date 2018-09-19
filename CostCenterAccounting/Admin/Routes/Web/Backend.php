<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\CostCenterAccounting\Models\PermissionState;
use Modules\CostCenterAccounting\Controller\BackendController;

return [
    '^.*/backend/accounting/costcenter/list.*$' => [
        [
            'dest' => '\Modules\CostCenterAccounting\Controller\BackendController:viewCostCenterList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COST_CENTER,
            ],
        ],
    ],
    '^.*/backend/accounting/costcenter/create.*$' => [
        [
            'dest' => '\Modules\CostCenterAccounting\Controller\BackendController:viewCostCenterCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::COST_CENTER,
            ],
        ],
    ],
    '^.*/backend/accounting/costcenter/profile.*$' => [
        [
            'dest' => '\Modules\CostCenterAccounting\Controller\BackendController:viewCostCenterProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COST_CENTER,
            ],
        ],
    ],
];
