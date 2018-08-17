<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Calendar\Models\PermissionState;
use Modules\Calendar\Controller;

return [
    '^.*/backend/calendar/dashboard.*$' => [
        [
            'dest' => '\Modules\Calendar\Controller:viewCalendarDashboard',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::CALENDAR,
            ],
        ],
    ],
];
