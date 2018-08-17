<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Messages\Models\PermissionState;
use Modules\Messages\Controller;

return [
    '^.*/backend/messages/dashboard.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageInbox',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/outbox.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageOutbox',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/trash.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageTrash',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/spam.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageSpam',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/settings.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/mail/create.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/mail/single.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageView',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/api/messages/mail/single.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageView',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
];
