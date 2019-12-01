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

use Modules\Helper\Models\HelperStatus;
use Modules\Helper\Models\Template;
use Modules\Helper\Models\TemplateDataType;

/**
 * @internal
 */
class TemplateTest extends \PHPUnit\Framework\TestCase
{
    protected Template $template;

    protected function setUp() : void
    {
        $this->template = new Template();
    }

    public function testDefault() : void
    {
        self::assertEquals(0, $this->template->getId());
        self::assertEquals(0, $this->template->getCreatedBy());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->template->getCreatedAt()->format('Y-m-d'));
        self::assertEquals('', $this->template->getName());
        self::assertEquals(HelperStatus::INACTIVE, $this->template->getStatus());
        self::assertEquals('', $this->template->getDescription());
        self::assertEquals('', $this->template->getDescriptionRaw());
        self::assertEquals([], $this->template->getExpected());
        self::assertEquals(0, $this->template->getSource());
        self::assertFalse($this->template->isStandalone());
        self::assertEquals(TemplateDataType::OTHER, $this->template->getDatatype());
    }

    public function testCreatedByInputOutput() : void
    {
        $this->template->setCreatedBy(1);
        self::assertEquals(1, $this->template->getCreatedBy());
    }

    public function testNameInputOutput() : void
    {
        $this->template->setName('Title');
        self::assertEquals('Title', $this->template->getName());
    }

    public function testStatusInputOutput() : void
    {
        $this->template->setStatus(HelperStatus::ACTIVE);
        self::assertEquals(HelperStatus::ACTIVE, $this->template->getStatus());
    }

    public function testStandalonInputOutput() : void
    {
        $this->template->setStandalone(true);
        self::assertTrue($this->template->isStandalone());
    }

    public function testDescriptionInputOutput() : void
    {
        $this->template->setDescription('Description');
        self::assertEquals('Description', $this->template->getDescription());
    }

    public function testDescriptionRawInputOutput() : void
    {
        $this->template->setDescriptionRaw('DescriptionRaw');
        self::assertEquals('DescriptionRaw', $this->template->getDescriptionRaw());
    }

    public function testExpectedInputOutput() : void
    {
        $this->template->setExpected(['source1.csv', 'source2.csv']);
        self::assertEquals(['source1.csv', 'source2.csv'], $this->template->getExpected());
    }

    public function testSourceInputOutput() : void
    {
        $this->template->setSource(4);
        self::assertEquals(4, $this->template->getSource());
    }

    public function testDatatypeInputOutput() : void
    {
        $this->template->setDatatype(TemplateDataType::GLOBAL_DB);
        self::assertEquals(TemplateDataType::GLOBAL_DB, $this->template->getDatatype());
    }
}
