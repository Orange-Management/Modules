<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/admin/monitoring/general.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller:viewMonitoringGeneral', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/monitoring/logs/list.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller:viewMonitoringLogList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/monitoring/logs/single.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller:viewMonitoringLogEntry', 
            'verb' => RouteVerb::GET,
        ],
    ],
];
