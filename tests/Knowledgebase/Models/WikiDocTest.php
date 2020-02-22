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

namespace Modules\tests\Knowledgebase\Models;

use Modules\Knowledgebase\Models\WikiDoc;
use Modules\Knowledgebase\Models\WikiStatus;

/**
 * @internal
 */
class WikiDocTest extends \PHPUnit\Framework\TestCase
{
    protected WikiDoc $doc;

    protected function setUp() : void
    {
        $this->doc = new WikiDoc();
    }

    public function testDefault() : void
    {
        self::assertEquals(0, $this->doc->getId());
        self::assertNull($this->doc->getApp());
        self::assertEquals('', $this->doc->getName());
        self::assertEquals('', $this->doc->getDoc());
        self::assertEquals('', $this->doc->getDocRaw());
        self::assertEquals(WikiStatus::ACTIVE, $this->doc->getStatus());
        self::assertEquals(0, $this->doc->getCategory());
        self::assertEquals('en', $this->doc->getLanguage());
        self::assertEquals([], $this->doc->getTags());
    }

    public function tesAppInputOutput() : void
    {
        $this->doc->setApp(2);
        self::assertEquals(2, $this->doc->getApp());
    }

    public function testNameInputOutput() : void
    {
        $this->doc->setName('Test name');
        self::assertEquals('Test name', $this->doc->getName());
    }

    public function testDocInputOutput() : void
    {
        $this->doc->setDoc('Test content');
        self::assertEquals('Test content', $this->doc->getDoc());
    }

    public function testDocRawInputOutput() : void
    {
        $this->doc->setDocRaw('Test content');
        self::assertEquals('Test content', $this->doc->getDocRaw());
    }

    public function testStatusInputOutput() : void
    {
        $this->doc->setStatus(WikiStatus::DRAFT);
        self::assertEquals(WikiStatus::DRAFT, $this->doc->getStatus());
    }

    public function testCategoryInputOutput() : void
    {
        $this->doc->setCategory(3);
        self::assertEquals(3, $this->doc->getCategory());
    }

    public function testLanguageInputOutput() : void
    {
        $this->doc->setLanguage('de');
        self::assertEquals('de', $this->doc->getLanguage());
    }

    public function testTagInputOutput() : void
    {
        $this->doc->addTag(5);
        self::assertEquals([5], $this->doc->getTags());
    }
}
