<?php

use Modules\Calendar\Controller\BackendController;
use Modules\Calendar\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/calendar/dashboard.*$' => [
        [
            'dest' => '\Modules\Calendar\Controller\BackendController:viewCalendarDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CALENDAR,
            ],
        ],
    ],
];
