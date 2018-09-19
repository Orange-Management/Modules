<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\StockTaking\Models\PermissionState;
use Modules\StockTaking\Controller\BackendController;

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
