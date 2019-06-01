<?php return [
    '^:help .*$' => [
        0 => [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 2,
            ],
        ],
        1 => [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 2,
            ],
        ],
        2 => [
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
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 2,
            ],
        ],
        1 => [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 2,
            ],
        ],
        2 => [
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
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 3,
            ],
        ],
        1 => [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 3,
            ],
        ],
        2 => [
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
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 2,
            ],
        ],
        1 => [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'permission' => [
                'module' => 'Help',
                'type' => 2,
                'state' => 2,
            ],
        ],
        2 => [
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
