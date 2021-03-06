<?php declare(strict_types=1);

use Modules\News\Controller\ApiController;
use Modules\News\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/news.*$' => [
        [
            'dest' => '\Modules\News\Controller\ApiController:apiNewsCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::NEWS,
            ],
        ],
        [
            'dest' => '\Modules\News\Controller\ApiController:apiNewsUpdate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::MODIFY,
                'state' => PermissionState::NEWS,
            ],
        ],
        [
            'dest' => '\Modules\News\Controller\ApiController:apiNewsGet',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::NEWS,
            ],
        ],
        [
            'dest' => '\Modules\News\Controller\ApiController:apiNewsDelete',
            'verb' => RouteVerb::DELETE,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::DELETE,
                'state' => PermissionState::NEWS,
            ],
        ],
    ],
];
