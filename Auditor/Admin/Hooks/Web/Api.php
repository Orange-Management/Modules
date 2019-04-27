<?php declare(strict_types=1);

return [
    'POST:Module:.*?\-create' => [
        'callback' => ['\Modules\Auditor\Controller\ApiController:apiLogCreate'],
    ],
    'POST:Module:.*?\-update' => [
        'callback' => ['\Modules\Auditor\Controller\ApiController:apiLogUpdate'],
    ],
    'POST:Module:.*?\-delete' => [
        'callback' => ['\Modules\Auditor\Controller\ApiController:apiLogDelete'],
    ],
];
