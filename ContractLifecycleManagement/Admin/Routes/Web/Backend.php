<?php

use Modules\ContractLifecycleManagement\Controller\BackendController;
use Modules\ContractLifecycleManagement\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/controlling/clm/dashboard.*$' => [
        [
            'dest' => '\Modules\ContractLifecycleManagement\Controller\BackendController:viewContractDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CLM,
            ],
        ],
    ],
];
