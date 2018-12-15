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

use Modules\Accounting\Models\Creditor;

class CreditorTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        $cc = new Creditor();
        self::assertEquals(0, $cc->getId());
        self::assertEquals(null, $cc->getAccount());
    }
}