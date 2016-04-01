<?php

$httpRoutes = [
    '^.*/backend/admin/settings/general.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewSettingsGeneral', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/admin/account/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewAccountList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/admin/account/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewAccountSettings', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/admin/account/create.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewAccountCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/admin/group/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewGroupList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/admin/group/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewGroupSettings', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/admin/group/create.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewGroupCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/admin/module/list.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewModuleList', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/admin/module/settings.*$' => [
        [
            'dest' => '\Modules\Admin\Controller:viewModuleProfile', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
