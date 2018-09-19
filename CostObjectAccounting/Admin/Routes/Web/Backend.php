<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\CostObjectAccounting\Models\PermissionState;
use Modules\CostObjectAccounting\Controller\BackendController;

return [
    '^.*/backend/accounting/costobject/list.*$' => [
        [
            'dest' => '\Modules\CostObjectAccounting\Controller\BackendController:viewCostObjectList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COST_OBJECT,
            ],
        ],
    ],
    '^.*/backend/accounting/costobject/create.*$' => [
        [
            'dest' => '\Modules\CostObjectAccounting\Controller\BackendController:viewCostObjectCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::COST_OBJECT,
            ],
        ],
    ],
    '^.*/backend/accounting/costobject/profile.*$' => [
        [
            'dest' => '\Modules\CostObjectAccounting\Controller\BackendController:viewCostObjectProfile',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::COST_OBJECT,
            ],
        ],
    ],
];
