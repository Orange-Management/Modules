<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\Editor\Admin;

class AdminTest extends \PHPUnit\Framework\TestCase
{
    protected const MODULE_NAME = 'Editor';
    protected const URI_LOAD = 'http://127.0.0.1/en/backend/editor';

    use \Modules\tests\ModuleTestTrait;
}
