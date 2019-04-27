<?php declare(strict_types=1);

use Modules\Exchange\Controller\ApiController;
use Modules\Exchange\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/admin/exchange/import/profile.*$' => [
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
    '^.*/admin/exchange/export/profile.*$' => [
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
