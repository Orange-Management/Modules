<?php declare(strict_types=1);
return [
    '^:help .*$' => [
        0 => [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'verb' => 16,
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 2,
            ],
        ],
    ],
    '^:help :user .*$' => [
        0 => [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'verb' => 16,
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 2,
            ],
        ],
    ],
    '^:help :dev .*$' => [
        0 => [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'verb' => 16,
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 3,
            ],
        ],
    ],
    '^:help :module .*$' => [
        0 => [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'verb' => 16,
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 2,
            ],
        ],
    ],
];
