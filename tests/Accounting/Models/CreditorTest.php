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


namespace Modules\tests\Accounting\Models;

use Modules\Accounting\Models\Creditor;

/**
 * @internal
 */
class CreditorTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $cc = new Creditor();
        self::assertEquals(0, $cc->getId());
        self::assertNull($cc->getAccount());
    }
}
