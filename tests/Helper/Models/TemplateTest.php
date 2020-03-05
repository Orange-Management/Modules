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

namespace Modules\tests\Helper\Models;

use Modules\Admin\Models\NullAccount;
use Modules\Helper\Models\HelperStatus;
use Modules\Helper\Models\NullReport;
use Modules\Helper\Models\Template;
use Modules\Helper\Models\TemplateDataType;
use Modules\Media\Models\NullCollection;
use Modules\Organization\Models\NullUnit;

/**
 * @testdox Modules\tests\Helper\Models\TemplateTest: Template model
 *
 * @internal
 */
class TemplateTest extends \PHPUnit\Framework\TestCase
{
    protected Template $template;

    protected function setUp() : void
    {
        $this->template = new Template();
    }

    /**
     * @testdox The model has the expected default values after initialization
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->template->getId());
        self::assertEquals(0, $this->template->getUnit()->getId());
        self::assertEquals(0, $this->template->getCreatedBy()->getId());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->template->getCreatedAt()->format('Y-m-d'));
        self::assertEquals('', $this->template->getName());
        self::assertEquals(HelperStatus::INACTIVE, $this->template->getStatus());
        self::assertEquals('', $this->template->getDescription());
        self::assertEquals('', $this->template->getDescriptionRaw());
        self::assertEquals([], $this->template->getExpected());
        self::assertEquals(0, $this->template->getSource()->getId());
        self::assertFalse($this->template->isStandalone());
        self::assertEquals(TemplateDataType::OTHER, $this->template->getDatatype());
        self::assertInstanceOf(NullReport::class, $this->template->getNewestReport());
    }

    /**
     * @testdox The unit can be set and returned correctly
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testUnitInputOutput() : void
    {
        $this->template->setUnit(new NullUnit(1));
        self::assertEquals(1, $this->template->getUnit()->getId());
    }
    /**
     * @testdox The creator can be set and returned correctly
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testCreatedByInputOutput() : void
    {
        $this->template->setCreatedBy(new NullAccount(1));
        self::assertEquals(1, $this->template->getCreatedBy()->getId());
    }

    /**
     * @testdox The title can be set and returned correctly
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testNameInputOutput() : void
    {
        $this->template->setName('Title');
        self::assertEquals('Title', $this->template->getName());
    }

    /**
     * @testdox The status can be set and returned correctly
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testStatusInputOutput() : void
    {
        $this->template->setStatus(HelperStatus::ACTIVE);
        self::assertEquals(HelperStatus::ACTIVE, $this->template->getStatus());
    }

    /**
     * @testdox The template can be set as standalone and returned correctly
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testStandalonInputOutput() : void
    {
        $this->template->setStandalone(true);
        self::assertTrue($this->template->isStandalone());
    }

    /**
     * @testdox The description can be set and returned correctly
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $this->template->setDescription('Description');
        self::assertEquals('Description', $this->template->getDescription());
    }

    /**
     * @testdox The raw description can be set and returned correctly
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testDescriptionRawInputOutput() : void
    {
        $this->template->setDescriptionRaw('DescriptionRaw');
        self::assertEquals('DescriptionRaw', $this->template->getDescriptionRaw());
    }

    /**
     * @testdox The expected report files can be set and returned correctly
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testExpectedInputOutput() : void
    {
        $this->template->setExpected(['source1.csv', 'source2.csv']);
        $this->template->addExpected('source3.csv');
        self::assertEquals(['source1.csv', 'source2.csv', 'source3.csv'], $this->template->getExpected());
    }

    /**
     * @testdox The source can be set and returned correctly
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testSourceInputOutput() : void
    {
        $this->template->setSource(new NullCollection(4));
        self::assertEquals(4, $this->template->getSource()->getId());
    }

    /**
     * @testdox The data storage type can be set and returned correctly
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testDatatypeInputOutput() : void
    {
        $this->template->setDatatype(TemplateDataType::GLOBAL_DB);
        self::assertEquals(TemplateDataType::GLOBAL_DB, $this->template->getDatatype());
    }

    /**
     * @testdox Template data can be turned into an array
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testToArray() : void
    {
        $this->template->setName('testName');
        $this->template->setDescription('testDescription');
        $this->template->setDescriptionRaw('testDescriptionRaw');
        $this->template->setStandalone(true);

        $array    = $this->template->toArray();
        $expected = [
            'id' => 0,
            'name' => 'testName',
            'description' => 'testDescription',
            'descriptionRaw' => 'testDescriptionRaw',
            'status' => HelperStatus::INACTIVE,
            'datatype' =>  TemplateDataType::OTHER,
            'standalone' => true,
        ];

        foreach ($expected as $key => $e) {
            if (!isset($array[$key]) || $array[$key] !== $e) {
                self::assertTrue(false);
            }
        }

        self::assertTrue(true);
    }

    /**
     * @testdox Template data can be json serialized
     * @covers Modules\Helper\Models\Template
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $this->template->setName('testName');
        $this->template->setDescription('testDescription');
        $this->template->setDescriptionRaw('testDescriptionRaw');
        $this->template->setStandalone(true);

        $array    = $this->template->jsonSerialize();
        $expected = [
            'id' => 0,
            'name' => 'testName',
            'description' => 'testDescription',
            'descriptionRaw' => 'testDescriptionRaw',
            'status' => HelperStatus::INACTIVE,
            'datatype' =>  TemplateDataType::OTHER,
            'standalone' => true,
        ];

        foreach ($expected as $key => $e) {
            if (!isset($array[$key]) || $array[$key] !== $e) {
                self::assertTrue(false);
            }
        }

        self::assertTrue(true);
    }
}
