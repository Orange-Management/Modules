<?php declare(strict_types=1);

use Modules\AssetManagement\Controller\BackendController;
use Modules\AssetManagement\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/accounting/asset/list.*$' => [
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
