<?php declare(strict_types=1);

use Modules\Draw\Controller\ApiController;
use Modules\Draw\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/draw.*$' => [
        [
            'dest' => '\Modules\Draw\Controller\ApiController:apiDrawCreate',
            'verb' => RouteVerb::SET,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::DRAW,
            ],
        ],
    ],
];
