<?php

use Modules\StockTaking\Controller\BackendController;
use Modules\StockTaking\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/backend/warehouse/stocktaking/list.*$' => [
        [
            'dest' => '\Modules\StockTaking\Controller\BackendController:viewStockTakingList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STOCK_TAKING,
            ],
        ],
    ],
];
