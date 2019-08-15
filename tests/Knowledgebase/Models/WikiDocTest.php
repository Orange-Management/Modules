<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */

namespace Modules\tests\Knowledgebase\Models;

use Modules\Knowledgebase\Models\WikiDoc;
use Modules\Knowledgebase\Models\WikiStatus;

/**
 * @internal
 */
class WikiDocTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $doc = new WikiDoc();

        self::assertEquals(0, $doc->getId());
        self::assertEquals('', $doc->getName());
        self::assertEquals('', $doc->getDoc());
        self::assertEquals(WikiStatus::ACTIVE, $doc->getStatus());
        self::assertEquals(0, $doc->getCategory());
        self::assertEquals('', $doc->getLanguage());
        self::assertEquals(0, $doc->getCreatedBy());
        self::assertInstanceOf('\DateTime', $doc->getCreatedAt());
        self::assertEquals([], $doc->getBadges());
    }

    public function testSetGet() : void
    {
        $doc = new WikiDoc();

        $doc->setName('Doc Name');
        $doc->setDoc('Doc content');
        $doc->setStatus(WikiStatus::DRAFT);
        $doc->setCategory(1);
        $doc->setCreatedBy(1);
        $doc->setLanguage('en');

        self::assertEquals('Doc Name', $doc->getName());
        self::assertEquals('Doc content', $doc->getDoc());
        self::assertEquals(WikiStatus::DRAFT, $doc->getStatus());
        self::assertEquals('en', $doc->getLanguage());
        self::assertEquals(1, $doc->getCategory());
        self::assertEquals(1, $doc->getCreatedBy());
    }
}
