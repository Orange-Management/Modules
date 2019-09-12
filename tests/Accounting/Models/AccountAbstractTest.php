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

use Modules\Accounting\Models\AccountAbstract;

/**
 * @internal
 */
class AccountAbstractTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp() : void
    {
        $this->account = new class() extends AccountAbstract {};
    }

    public function testDefault() : void
    {
        self::assertEquals(0, $this->account->getId());
        self::assertNull($this->account->getEntryById(1));
        self::assertEquals([], $this->account->getEntriesByDate(
            new \DateTime('now'),
            new \DateTime('now')
        ));
    }
}
