<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Help
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

use Modules\Help\Controller\SearchController;
use Modules\Help\Models\PermissionState;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^:help .*$' => [
        [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'verb' => RouteVerb::ANY,
            'permission' => [
                'module' => SearchController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_MODULE,
            ],
        ],
    ],
    '^:help :user .*$' => [
        [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'verb' => RouteVerb::ANY,
            'permission' => [
                'module' => SearchController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_MODULE,
            ],
        ],
    ],
    '^:help :dev .*$' => [
        [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'verb' => RouteVerb::ANY,
            'permission' => [
                'module' => SearchController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_DEVELOPER,
            ],
        ],
    ],
    '^:help :module .*$' => [
        [
            'dest' => '\Modules\Help\Controller\SearchController:searchHelp',
            'verb' => RouteVerb::ANY,
            'permission' => [
                'module' => SearchController::MODULE_NAME,
                'type'  => PermissionType::READ,
                'state' => PermissionState::HELP_MODULE,
            ],
        ],
    ],
];
