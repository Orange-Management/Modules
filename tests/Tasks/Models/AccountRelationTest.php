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

namespace Modules\tests\Tasks\Models;

use Modules\Tasks\Models\AccountRelation;
use Modules\Tasks\Models\DutyType;

class AccountRelationTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $obj = new AccountRelation();
        self::assertEquals(0, $obj->getId());
        self::assertEquals(0, $obj->getRelation());
        self::assertEquals(DutyType::TO, $obj->getDuty());
    }

    public function testSetGet()
    {
        $obj = new AccountRelation(1, DutyType::CC);
        self::assertEquals(1, $obj->getRelation());
        self::assertEquals(DutyType::CC, $obj->getDuty());

        self::assertEquals([
            'id' => 0,
            'duty' => DutyType::CC,
            'relation' => 1,
        ], $obj->toArray());
        self::assertEquals($obj->toArray(), $obj->jsonSerialize());

        $obj->setDuty(DutyType::TO);
        self::assertEquals(DutyType::TO, $obj->getDuty());
    }
}
