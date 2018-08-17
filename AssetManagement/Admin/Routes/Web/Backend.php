<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\AssetManagement\Models\PermissionState;
use Modules\AssetManagement\Controller;


return [
    '^.*/backend/accounting/asset/list.*$' => [
        [
            'dest' => '\Modules\AssetManagement\Controller:viewAssetManagementList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::ASSET,
            ],
        ],
    ],
];
