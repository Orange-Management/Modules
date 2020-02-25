<?php declare(strict_types=1);
return [
    '^/timerecording$' => [
        0 => [
            'dest' => '\Modules\HumanResourceTimeRecording\Controller\TimerecordingController:viewDashboard',
            'verb' => 1,
            'permission' => [
                'module' => 'HumanResourceTimeRecording',
                'type' => 2,
                'state' => 1,
            ],
        ],
    ],
    '^.*/timerecording/dashboard.*$' => [
        0 => [
            'dest' => '\Modules\HumanResourceTimeRecording\Controller\TimerecordingController:viewDashboard',
            'verb' => 1,
            'permission' => [
                'module' => 'HumanResourceTimeRecording',
                'type' => 2,
                'state' => 1,
            ],
        ],
    ],
];
