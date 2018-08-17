<?php

use phpOMS\Router\RouteVerb;
use phpOMS\Account\PermissionType;
use Modules\StockTaking\Models\PermissionState;
use Modules\StockTaking\Controller;

return [
    '^.*/backend/warehouse/stocktaking/list.*$' => [
        [
            'dest' => '\Modules\StockTaking\Controller:viewStockTakingList',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => Controller::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::STOCK_TAKING,
            ],
        ],
    ],
];
