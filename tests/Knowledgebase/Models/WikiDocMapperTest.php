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

use Modules\Knowledgebase\Models\NullWikiCategory;
use Modules\Knowledgebase\Models\WikiDoc;
use Modules\Knowledgebase\Models\WikiDocMapper;
use Modules\Knowledgebase\Models\WikiStatus;
use phpOMS\Utils\RnG\Text;

/**
 * @testdox Modules\tests\Knowledgebase\Models\WikiDocMapperTest: Wiki document mapper
 *
 * @internal
 */
class WikiDocMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testdox The model can be created and read from the database
     * @covers Modules\Knowledgebase\Models\WikiDocMapper
     * @group module
     */
    public function testCR() : void
    {
        $doc = new WikiDoc();

        $doc->setName('Doc Name');
        $doc->setDoc('Doc content');
        $doc->setStatus(WikiStatus::DRAFT);
        $doc->setCategory(new NullWikiCategory(1));
        $doc->setLanguage('en');

        $id = WikiDocMapper::create($doc);
        self::assertGreaterThan(0, $doc->getId());
        self::assertEquals($id, $doc->getId());

        $docR = WikiDocMapper::get($doc->getId());
        self::assertEquals($doc->getName(), $docR->getName());
        self::assertEquals($doc->getDoc(), $docR->getDoc());
        self::assertEquals($doc->getStatus(), $docR->getStatus());
        self::assertEquals($doc->getLanguage(), $docR->getLanguage());
        self::assertEquals($doc->getCategory()->getId(), $docR->getCategory()->getId());
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 30; ++$i) {
            $text = new Text();
            $doc  = new WikiDoc();

            $doc->setName($text->generateText(\mt_rand(1, 3)));
            $doc->setDoc($text->generateText(\mt_rand(100, 500)));
            $doc->setStatus(WikiStatus::ACTIVE);
            $doc->setCategory(new NullWikiCategory(\mt_rand(1, 9)));
            $doc->setLanguage('en');

            $id = WikiDocMapper::create($doc);
        }
    }
}
