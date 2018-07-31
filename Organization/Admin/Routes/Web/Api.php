<?php

use phpOMS\Router\RouteVerb;

return [
    '^.*/api/organization/position.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiPositionCreate',
            'verb' => RouteVerb::PUT,
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiPositionGet',
            'verb' => RouteVerb::GET,
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiPositionSet',
            'verb' => RouteVerb::SET,
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiPositionDelete',
            'verb' => RouteVerb::DELETE,
        ],
    ],
    '^.*/api/organization/department.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiDepartmentCreate',
            'verb' => RouteVerb::PUT,
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiDepartmentGet',
            'verb' => RouteVerb::GET,
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiDepartmentSet',
            'verb' => RouteVerb::SET,
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiDepartmentDelete',
            'verb' => RouteVerb::DELETE,
        ],
    ],
    '^.*/api/organization/unit.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiUnitCreate',
            'verb' => RouteVerb::PUT,
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiUnitGet',
            'verb' => RouteVerb::GET,
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiUnitSet',
            'verb' => RouteVerb::SET,
        ],
        [
            'dest' => '\Modules\Organization\Controller:apiUnitDelete',
            'verb' => RouteVerb::DELETE,
        ],
    ],

    '^.*/api/organization/find/unit.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiUnitFind',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/api/organization/find/department.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiDepartmentFind',
            'verb' => RouteVerb::GET,
        ],
    ],
    '^.*/api/organization/find/position.*$' => [
        [
            'dest' => '\Modules\Organization\Controller:apiPositionFind',
            'verb' => RouteVerb::GET,
        ],
    ],
];
