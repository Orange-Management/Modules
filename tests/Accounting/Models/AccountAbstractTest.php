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

use Modules\Accounting\Models\AccountAbstract;

class AccountAbstractTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->account = new class() extends AccountAbstract {};
    }

    public function testDefault()
    {
        self::assertEquals(0, $this->account->getId());
        self::assertEquals(null, $this->account->getEntryById(1));
        self::assertEquals([], $this->account->getEntriesByDate(
            new \DateTime('now'),
            new \DateTime('now')
        ));
    }
}
