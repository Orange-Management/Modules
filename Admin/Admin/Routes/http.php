<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/admin/settings/general.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewSettingsGeneral', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/account/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewAccountList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/account/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewAccountSettings', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/account/create.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewAccountCreate', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/group/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewGroupList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/group/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewGroupSettings', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/group/create.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewGroupCreate', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/module/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewModuleList', 
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/backend/admin/module/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewModuleProfile', 
            'verb' => RouteVerb::GET,
        ],
    ],

    '^.*/api/admin/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:apiSettingsSet',
            'verb' => RouteVerb::SET,
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiSettingsGet',
            'verb' => RouteVerb::GET,
        ],
    ],

    '^.*/api/admin/group.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:apiGroupCreate',
            'verb' => RouteVerb::PUT,
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiGroupUpdate',
            'verb' => RouteVerb::SET,
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiGroupDelete',
            'verb' => RouteVerb::DELETE,
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiGroupGet',
            'verb' => RouteVerb::GET,
        ],
    ],

    '^.*/api/admin/account.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:apiAccountCreate',
            'verb' => RouteVerb::PUT,
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiAccountUpdate',
            'verb' => RouteVerb::SET,
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiAccountDelete',
            'verb' => RouteVerb::DELETE,
        ],
        [
            'dest' => '\Modules\Admin\Controller:apiAccountGet',
            'verb' => RouteVerb::GET,
        ],
    ],
];
