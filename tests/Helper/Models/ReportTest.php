<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */

namespace Modules\tests\Helper\Models;

use Modules\Helper\Models\HelperStatus;
use Modules\Helper\Models\Report;

/**
 * @internal
 */
class ReportTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $report = new Report();

        self::assertEquals(0, $report->getId());
        self::assertEquals(0, $report->getCreatedBy());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $report->getCreatedAt()->format('Y-m-d'));
        self::assertEquals('', $report->getTitle());
        self::assertEquals(HelperStatus::INACTIVE, $report->getStatus());
        self::assertEquals('', $report->getDescription());
        self::assertEquals(0, $report->getTemplate());
        self::assertEquals(0, $report->getSource());
    }

    public function testSetGet() : void
    {
        $report = new Report();

        $report->setCreatedBy(1);
        self::assertEquals(1, $report->getCreatedBy());

        $report->setTitle('Title');
        self::assertEquals('Title', $report->getTitle());

        $report->setStatus(HelperStatus::ACTIVE);
        self::assertEquals(HelperStatus::ACTIVE, $report->getStatus());

        $report->setDescription('Description');
        self::assertEquals('Description', $report->getDescription());

        $report->setTemplate(11);
        self::assertEquals(11, $report->getTemplate());

        $report->setSource(4);
        self::assertEquals(4, $report->getSource());
    }
}
