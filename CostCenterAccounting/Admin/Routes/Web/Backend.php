<?php declare(strict_types=1);

use Modules\CostCenterAccounting\Controller\BackendController;
use Modules\CostCenterAccounting\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/accounting/costcenter/list.*$' => [
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
    '^.*/accounting/costcenter/create.*$' => [
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
    '^.*/accounting/costcenter/profile.*$' => [
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
