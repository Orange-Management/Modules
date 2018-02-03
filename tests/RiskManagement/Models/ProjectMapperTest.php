<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\RiskManagement\Models;

use Modules\RiskManagement\Models\Project;
use Modules\RiskManagement\Models\ProjectMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\DatabasePool;

class ProjectMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD()
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
