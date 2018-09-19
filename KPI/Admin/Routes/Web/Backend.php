<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\KPI\Models\PermissionState;
use Modules\KPI\Controller\BackendController;

return [
    '^.*/backend/controlling/kpi/dashboard.*$' => [
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
