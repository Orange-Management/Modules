<?php

return [
    'PRE:Module:.*?\-create' => [
        'callback' => ['\Modules\Auditor\Controller\ApiController:apiLogCreate'],
    ],
    'PRE:Module:.*?\-update' => [
        'callback' => ['\Modules\Auditor\Controller\ApiController:apiLogUpdate'],
    ],
    'PRE:Module:.*?\-delete' => [
        'callback' => ['\Modules\Auditor\Controller\ApiController:apiLogDelete'],
    ],
];
