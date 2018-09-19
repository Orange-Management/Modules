<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Calendar\Models\PermissionState;
use Modules\Calendar\Controller\BackendController;

return [
    '^.*/backend/calendar/dashboard.*$' => [
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
