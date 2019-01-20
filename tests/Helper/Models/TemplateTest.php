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

namespace Modules\tests\Helper\Models;

use Modules\Helper\Models\HelperStatus;
use Modules\Helper\Models\Template;
use Modules\Helper\Models\TemplateDataType;

class TemplateTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult() : void
    {
        $template = new Template();

        self::assertEquals(0, $template->getId());
        self::assertEquals(0, $template->getCreatedBy());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $template->getCreatedAt()->format('Y-m-d'));
        self::assertEquals('', $template->getName());
        self::assertEquals(HelperStatus::INACTIVE, $template->getStatus());
        self::assertEquals('', $template->getDescription());
        self::assertEquals('', $template->getDescriptionRaw());
        self::assertEquals([], $template->getExpected());
        self::assertEquals(0, $template->getSource());
        self::assertFalse($template->isStandalone());
        self::assertEquals(TemplateDataType::OTHER, $template->getDatatype());
    }

    public function testSetGet() : void
    {
        $template = new Template();

        $template->setCreatedBy(1);
        self::assertEquals(1, $template->getCreatedBy());

        $template->setName('Title');
        self::assertEquals('Title', $template->getName());

        $template->setStatus(HelperStatus::ACTIVE);
        self::assertEquals(HelperStatus::ACTIVE, $template->getStatus());

        $template->setStandalone(true);
        self::assertTrue($template->isStandalone());

        $template->setDescription('Description');
        self::assertEquals('Description', $template->getDescription());

        $template->setDescriptionRaw('DescriptionRaw');
        self::assertEquals('DescriptionRaw', $template->getDescriptionRaw());

        $template->setExpected(['source1.csv', 'source2.csv']);
        self::assertEquals(['source1.csv', 'source2.csv'], $template->getExpected());

        $template->setSource(4);
        self::assertEquals(4, $template->getSource());

        $template->setDatatype(TemplateDataType::GLOBAL_DB);
        self::assertEquals(TemplateDataType::GLOBAL_DB, $template->getDatatype());
    }
}
