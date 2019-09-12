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

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\Project;
use Modules\RiskManagement\Models\ProjectMapper;

/**
 * @internal
 */
class ProjectMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $obj = new Project();
        $obj->setProject(1);
        $obj->setResponsible(1);
        $obj->setDeputy(1);

        ProjectMapper::create($obj);

        $objR = ProjectMapper::get($obj->getId());
        self::assertEquals($obj->getProject(), $objR->getProject()->getId());
        self::assertEquals($obj->getResponsible(), $objR->getResponsible());
        self::assertEquals($obj->getDeputy(), $objR->getDeputy());
    }
}
