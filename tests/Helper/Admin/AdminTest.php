<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\tests\Helper\Admin;

/**
 * @internal
 */
class AdminTest extends \PHPUnit\Framework\TestCase
{
    protected const MODULE_NAME = 'Helper';
    protected const URI_LOAD = 'http://127.0.0.1/en/backend/helper';

    use \Modules\tests\ModuleTestTrait;
}
