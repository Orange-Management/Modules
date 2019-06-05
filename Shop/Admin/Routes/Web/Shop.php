<?php declare(strict_types=1);

use Modules\Shop\Controller\ShopController;
use Modules\Shop\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^(\/)(\?.*)*$' => [
        [
            'dest' => '\Modules\Shop\Controller\ShopController:viewWelcome',
            'verb' => RouteVerb::GET,
            'permission' => [
                'module' => ShopController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::SHOP,
            ],
        ],
    ],
];