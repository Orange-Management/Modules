<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\Messages\Models\PermissionState;
use Modules\Messages\Controller\BackendController;

return [
    '^.*/backend/messages/dashboard.*$' => [
        [
            'dest' => '\Modules\Messages\Controller\BackendController:viewMessageInbox',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/outbox.*$' => [
        [
            'dest' => '\Modules\Messages\Controller\BackendController:viewMessageOutbox',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/trash.*$' => [
        [
            'dest' => '\Modules\Messages\Controller\BackendController:viewMessageTrash',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/spam.*$' => [
        [
            'dest' => '\Modules\Messages\Controller\BackendController:viewMessageSpam',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/settings.*$' => [
        [
            'dest' => '\Modules\Messages\Controller\BackendController:viewMessageSettings',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/mail/create.*$' => [
        [
            'dest' => '\Modules\Messages\Controller\BackendController:viewMessageCreate',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::CREATE,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/backend/messages/mail/single.*$' => [
        [
            'dest' => '\Modules\Messages\Controller\BackendController:viewMessageView',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
    '^.*/api/messages/mail/single.*$' => [
        [
            'dest' => '\Modules\Messages\Controller\BackendController:viewMessageView',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::MESSAGE,
            ],
        ],
    ],
];
