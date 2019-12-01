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
use Modules\Helper\Models\Report;

/**
 * @internal
 */
class ReportTest extends \PHPUnit\Framework\TestCase
{
    protected Report $report;

    protected function setUp() : void
    {
        $this->report = new Report();
    }

    public function testDefault() : void
    {
        self::assertEquals(0, $this->report->getId());
        self::assertEquals(0, $this->report->getCreatedBy());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->report->getCreatedAt()->format('Y-m-d'));
        self::assertEquals('', $this->report->getTitle());
        self::assertEquals(HelperStatus::INACTIVE, $this->report->getStatus());
        self::assertEquals('', $this->report->getDescription());
        self::assertEquals(0, $this->report->getTemplate());
        self::assertEquals(0, $this->report->getSource());
    }

    public function testCreatedByInputOutput() : void
    {
        $this->report->setCreatedBy(1);
        self::assertEquals(1, $this->report->getCreatedBy());
    }

    public function testTitleInputOutput() : void
    {
        $this->report->setTitle('Title');
        self::assertEquals('Title', $this->report->getTitle());
    }

    public function testStatusInputOutput() : void
    {
        $this->report->setStatus(HelperStatus::ACTIVE);
        self::assertEquals(HelperStatus::ACTIVE, $this->report->getStatus());
    }

    public function testDescriptionInputOutput() : void
    {
        $this->report->setDescription('Description');
        self::assertEquals('Description', $this->report->getDescription());
    }

    public function testTemplateInputOutput() : void
    {
        $this->report->setTemplate(11);
        self::assertEquals(11, $this->report->getTemplate());
    }

    public function testSourceInputOutput() : void
    {
        $this->report->setSource(4);
        self::assertEquals(4, $this->report->getSource());
    }
}
