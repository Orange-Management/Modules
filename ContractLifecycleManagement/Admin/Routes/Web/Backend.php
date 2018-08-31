<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\ContractLifecycleManagement\Models\PermissionState;
use Modules\ContractLifecycleManagement\Controller;

return [
    '^.*/backend/controlling/clm/dashboard.*$' => [
        [
            'dest' => '\Modules\ContractLifecycleManagement\Controller:viewContractDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CLM,
            ],
        ],
    ],
];
