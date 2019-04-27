<?php declare(strict_types=1);

use Modules\DatabaseEditor\Controller\ApiController;
use Modules\DatabaseEditor\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/dbeditor/query.*$' => [
        [
            'dest' => '\Modules\DatabaseEditor\Controller\ApiController:apiQueryExecute',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DATABASE_EDITOR,
            ],
        ],
    ],
    '^.*/dbeditor/connection.*$' => [
        [
            'dest' => '\Modules\DatabaseEditor\Controller\ApiController:apiConnectionTest',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::DATABASE_EDITOR,
            ],
        ],
    ],
];
