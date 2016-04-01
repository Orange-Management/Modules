<?php

$httpRoutes = [
    '^.*/backend/messages/dashboard.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageInbox', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/messages/outbox.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageOutbox', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/messages/trash.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageTrash', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/messages/spam.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageSpam', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/messages/settings.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageSettings', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/messages/mail/create.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageCreate', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/backend/messages/mail/single.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageView', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::HTML,
            'layout' => ViewLayout::MAIN,
        ],
    ],
    '^.*/api/messages/mail/single.*$' => [
        [
            'dest' => '\Modules\Messages\Controller:viewMessageView', 
            'verb' => RouteVerb::GET,
            'result' => ViewType::JSON,
            'layout' => ViewLayout::MAIN,
        ],
    ],
];
