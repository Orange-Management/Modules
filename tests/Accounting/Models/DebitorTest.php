<?php declare(strict_types=1);
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

namespace Modules\tests\Accounting\Models;

use Modules\Accounting\Models\Debitor;

/**
 * @internal
 */
class DebitorTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $cc = new Debitor();
        self::assertEquals(0, $cc->getId());
        self::assertNull($cc->getAccount());
    }
}
