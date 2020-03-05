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

namespace Modules\tests\Auditor\Models;

use Modules\Auditor\Models\Audit;
use phpOMS\Account\Account;

/**
 * @testdox Modules\tests\Auditor\Models\AuditTest: Audit model
 *
 * @internal
 */
class AuditTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testdox The model has the expected default values after initialization
     * @covers Modules\Auditor\Models\Audit
     * @group module
     */
    public function testDefault() : void
    {
        $audit = new Audit();
        self::assertEquals(0, $audit->getId());
        self::assertEquals(0, $audit->getType());
        self::assertEquals(0, $audit->getSubType());
        self::assertNull($audit->getModule());
        self::assertNull($audit->getRef());
        self::assertNull($audit->getContent());
        self::assertNull($audit->getOld());
        self::assertNull($audit->getNew());
        self::assertEquals(0, $audit->getCreatedBy()->getId());
        self::assertInstanceOf('\DateTime', $audit->getCreatedAt());
    }

    /**
     * @testdox The model can be initialized correctly
     * @covers Modules\Auditor\Models\Audit
     * @group module
     */
    public function testConstructorInputOutput() : void
    {
        $audit = new Audit(
            new Account(),
            'old', 'new',
            1, 2,
            '3',
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
