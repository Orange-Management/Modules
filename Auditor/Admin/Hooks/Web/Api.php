<?php

return [
    'PRE:Module:.*?\-create' => '\Modules\Auditor\Controller\ApiController:apiLogCreate',
    'PRE:Module:.*?\-update' => '\Modules\Auditor\Controller\ApiController:apiLogUpdate',
    'PRE:Module:.*?\-delete' => '\Modules\Auditor\Controller\ApiController:apiLogDelete',
];
