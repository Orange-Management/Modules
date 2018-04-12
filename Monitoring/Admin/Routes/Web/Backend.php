<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/admin/monitoring/general.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller:viewMonitoringGeneral',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/monitoring/log/list.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller:viewMonitoringLogList',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/monitoring/log/single.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller:viewMonitoringLogEntry',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/monitoring/security/dashboard.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller:viewMonitoringSecurityDashboard',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/monitoring/security/file/list.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller:viewMonitoringSecurityFileList',
            'verb' => RouteVerb::GET,
        ],
    ],
];
