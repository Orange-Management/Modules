<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\ContractLifecycleManagement\Models\PermissionState;
use Modules\ContractLifecycleManagement\Controller\BackendController;

return [
    '^.*/backend/controlling/clm/dashboard.*$' => [
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
