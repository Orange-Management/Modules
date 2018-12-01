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

final class AccountAbstractTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->account = new class() extends AccountAbstract {};
    }

    public function testDefault()
    {
        self::assertEquals(0, $this->account->getId());
        self::assertEquals(null, $this->account->getPositiveParent());
        self::assertEquals(null, $this->account->getNegativeParent());
    }

    public function testSetGet()
    {
        $this->account->setPositiveParent(2);
        self::assertEquals(2, $this->account->getPositiveParent());

        $this->account->setNegativeParent(3);
        self::assertEquals(3, $this->account->getNegativeParent());
    }
}
