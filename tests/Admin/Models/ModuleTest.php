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
 * @testdox Modules\tests\Admin\Models\ModuleTest: Module container
 *
 * @internal
 */
class ModuleTest extends \PHPUnit\Framework\TestCase
{
    protected Module $module;

    protected function setUp() : void
    {
        $this->module = new Module();
    }

    /**
     * @testdox The module has the expected default values after initialization
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->module->getId());
        self::assertInstanceOf('\DateTime', $this->module->getCreatedAt());
        self::assertEquals('', $this->module->getName());
        self::assertEquals('', $this->module->getDescription());
        self::assertEquals(ModuleStatus::INACTIVE, $this->module->getStatus());
        self::assertEquals(\json_encode($this->module->jsonSerialize()), $this->module->__toString());
        self::assertEquals($this->module->jsonSerialize(), $this->module->toArray());
    }

    /**
     * @testdox The name can be set and returned
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testNameInputOutput() : void
    {
        $this->module->setName('Name');
        self::assertEquals('Name', $this->module->getName());
    }

    /**
     * @testdox The description can be set and returned
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $this->module->setDescription('Desc');
        self::assertEquals('Desc', $this->module->getDescription());
    }

    /**
     * @testdox The status can be set and returned
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testStatusInputOutput() : void
    {
        $this->module->setStatus(ModuleStatus::ACTIVE);
        self::assertEquals(ModuleStatus::ACTIVE, $this->module->getStatus());
    }

    /**
     * @testdox The module can be serialized
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testSerializations() : void
    {
        self::assertEquals(\json_encode($this->module->jsonSerialize()), $this->module->__toString());
        self::assertEquals($this->module->jsonSerialize(), $this->module->toArray());
    }

    /**
     * @testdox A invalid status throws a InvalidEnumValue exception
     * @covers Modules\Admin\Models\Module
     * @group module
     */
    public function testInvalidStatus() : void
    {
        self::expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);

        $this->module->setStatus(9999);
    }
}
