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

namespace Modules\tests\Accounting\Models;

use Modules\Accounting\Models\Debitor;

class DebitorTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $cc = new Debitor();
        self::assertEquals(0, $cc->getId());
        self::assertEquals(null, $cc->getAccount());
    }
}