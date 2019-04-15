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

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\Project;

class ProjectTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $obj = new Project();

        self::assertEquals(0, $obj->getId());
        self::assertEquals(0, $obj->getProject());
        self::assertEquals(null, $obj->getResponsible());
        self::assertEquals(null, $obj->getDeputy());
    }

    public function testSetGet() : void
    {
        $obj = new Project();

        $obj->setResponsible(1);
        self::assertEquals(1, $obj->getResponsible());

        $obj->setDeputy(1);
        self::assertEquals(1, $obj->getDeputy());

        $obj->setProject(1);
        self::assertEquals(1, $obj->getProject());
    }
}
