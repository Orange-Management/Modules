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

namespace Modules\tests\Auditor\Admin;

use phpOMS\ApplicationAbstract;
use phpOMS\Dispatcher\Dispatcher;
use phpOMS\Message\Http\Request;
use phpOMS\Module\ModuleManager;
use phpOMS\Uri\Http;
use phpOMS\Utils\TestUtils;

class AdminTest extends \PHPUnit\Framework\TestCase
{
    protected const MODULE_NAME = 'Auditor';
    protected const URI_LOAD = 'http://127.0.0.1/en/backend/admin/audit';

    use \Modules\tests\ModuleTestTrait;
}
