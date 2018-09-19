<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\AssetManagement\Models\PermissionState;
use Modules\AssetManagement\Controller\BackendController;


return [
    '^.*/backend/accounting/asset/list.*$' => [
        [
            'dest' => '\Modules\AssetManagement\Controller\BackendController:viewAssetManagementList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ASSET,
            ],
        ],
    ],
];
