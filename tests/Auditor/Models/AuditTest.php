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

namespace Modules\tests\Auditor\Models;

use Modules\Auditor\Models\Audit;
use phpOMS\Account\Account;

class AuditTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $audit = new Audit(new Account(), null, null);
        self::assertEquals(0, $audit->getType());
        self::assertEquals(0, $audit->getSubType());
        self::assertEquals(null, $audit->getModule());
        self::assertEquals(null, $audit->getRef());
        self::assertEquals(null, $audit->getContent());
        self::assertEquals(null, $audit->getOld());
        self::assertEquals(null, $audit->getNew());
        self::assertEquals(0, $audit->getCreatedBy()->getId());
        self::assertInstanceOf('\DateTime', $audit->getCreatedAt());
    }

    public function testSetGet() : void
    {
        $audit = new Audit(
            new Account(),
            'old', 'new',
            1, 2,
            3,
            'test',
            'content'
        );

        self::assertEquals(1, $audit->getType());
        self::assertEquals(2, $audit->getSubType());
        self::assertEquals(3, $audit->getModule());
        self::assertEquals('test', $audit->getRef());
        self::assertEquals('content', $audit->getContent());
        self::assertEquals('old', $audit->getOld());
        self::assertEquals('new', $audit->getNew());
        self::assertEquals(0, $audit->getCreatedBy()->getId());
    }
}
