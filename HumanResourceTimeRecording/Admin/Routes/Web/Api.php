<?php declare(strict_types=1);

use Modules\HumanResourceTimeRecording\Controller\ApiController;
use Modules\HumanResourceTimeRecording\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/humanresource/timerecording/session.*$' => [
        [
            'dest' => '\Modules\HumanResourceTimeRecording\Controller\ApiController:apiSessionCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SESSION,
            ],
        ],
    ],
    '^.*/humanresource/timerecording/element.*$' => [
        [
            'dest' => '\Modules\HumanResourceTimeRecording\Controller\ApiController:apiSessionElementCreate',
            'verb' => RouteVerb::PUT,
            'permission' => [
                'module' => ApiController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::SESSION_ELEMENT,
            ],
        ],
    ],
];
