<?php

use Modules\KPI\Controller\BackendController;
use Modules\KPI\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/controlling/kpi/dashboard.*$' => [
        [
            'dest' => '\Modules\KPI\Controller\BackendController:viewKPIDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::KPI,
            ],
        ],
    ],
];
