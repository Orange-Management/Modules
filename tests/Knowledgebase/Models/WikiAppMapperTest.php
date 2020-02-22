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

use Modules\Knowledgebase\Models\WikiApp;
use Modules\Knowledgebase\Models\WikiAppMapper;
use phpOMS\Utils\RnG\Text;

/**
 * @testdox Modules\tests\Knowledgebase\Models\WikiAppMapperTest: Wiki application mapper
 *
 * @internal
 */
class WikiAppMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testdox The model can be created and read from the database
     * @covers Modules\Knowledgebase\Models\WikiAppMapper
     * @group module
     */
    public function testCR() : void
    {
        $app = new WikiApp();

        $app->setName('Test Category');

        $id = WikiAppMapper::create($app);
        self::assertGreaterThan(0, $app->getId());
        self::assertEquals($id, $app->getId());

        $appR = WikiAppMapper::get($app->getId());
        self::assertEquals($app->getName(), $appR->getName());
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 3; ++$i) {
            $text = new Text();
            $app  = new WikiApp();

            $app->setName($text->generateText(\mt_rand(1, 3)));

            $id = WikiAppMapper::create($app);
        }
    }
}
