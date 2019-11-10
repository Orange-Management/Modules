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
    /**
     * @covers Modules\Admin\Models\Module
     */
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

    /**
     * @covers Modules\Admin\Models\Module
     */
    public function testNameInputOutput() : void
    {
        $module = new Module();

        $module->setName('Name');
        self::assertEquals('Name', $module->getName());
    }

    /**
     * @covers Modules\Admin\Models\Module
     */
    public function testDescriptionInputOutput() : void
    {
        $module = new Module();

        $module->setDescription('Desc');
        self::assertEquals('Desc', $module->getDescription());
    }

    /**
     * @covers Modules\Admin\Models\Module
     */
    public function testStatusInputOutput() : void
    {
        $module = new Module();

        $module->setStatus(ModuleStatus::ACTIVE);
        self::assertEquals(ModuleStatus::ACTIVE, $module->getStatus());
    }

    /**
     * @covers Modules\Admin\Models\Module
     */
    public function testSerializations() : void
    {
        $module = new Module();

        self::assertEquals(\json_encode($module->jsonSerialize()), $module->__toString());
        self::assertEquals($module->jsonSerialize(), $module->toArray());
    }
}
