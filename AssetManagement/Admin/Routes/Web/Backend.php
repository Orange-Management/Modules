<?php

use Modules\AssetManagement\Controller\BackendController;
use Modules\AssetManagement\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;


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
