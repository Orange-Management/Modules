<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Exchange\Models\PermissionState;
use Modules\Exchange\Controller\ApiController;

return [
    '^.*/api/admin/exchange/import/profile.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller\ApiController:apiExchangeImport',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::IMPORT,
            ],
        ],
    ],
    '^.*/api/admin/exchange/export/profile.*$' => [
        [
            'dest' => '\Modules\Exchange\Controller\ApiController:apiExchangeExport',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::EXPORT,
            ],
        ],
    ],
];
