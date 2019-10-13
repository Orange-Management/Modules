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

namespace Modules\tests\Admin\Models;

use Modules\Admin\Models\Module;
use phpOMS\Module\ModuleStatus;

/**
 * @internal
 */
class ModuleTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $module = new Module();
        self::assertEquals(0, $module->getId());
        self::assertInstanceOf('\DateTime', $module->getCreatedAt());
        self::assertEquals('', $module->getName());
        self::assertEquals('', $module->getDescription());
        self::assertEquals(ModuleStatus::INACTIVE, $module->getStatus());
        self::assertEquals(\json_encode($module->jsonSerialize()), $module->__toString());
        self::assertEquals($module->jsonSerialize(), $module->toArray());
    }

    public function testGetSet() : void
    {
        $module = new Module();

        $module->setName('Name');
        self::assertEquals('Name', $module->getName());

        $module->setDescription('Desc');
        self::assertEquals('Desc', $module->getDescription());

        $module->setStatus(ModuleStatus::ACTIVE);
        self::assertEquals(ModuleStatus::ACTIVE, $module->getStatus());

        self::assertEquals(\json_encode($module->jsonSerialize()), $module->__toString());
        self::assertEquals($module->jsonSerialize(), $module->toArray());
    }
}
