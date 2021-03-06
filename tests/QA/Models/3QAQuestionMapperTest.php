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

namespace Modules\tests\QA\Models;

use Modules\Admin\Models\NullAccount;
use Modules\QA\Models\NullQACategory;
use Modules\QA\Models\QAQuestion;
use Modules\QA\Models\QAQuestionMapper;
use Modules\QA\Models\QAQuestionStatus;
use phpOMS\Utils\RnG\Text;

/**
 * @internal
 */
class QAQuestionMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $question = new QAQuestion();

        $question->setName('Question Name');
        $question->setQuestion('Question content');
        $question->setStatus(QAQuestionStatus::ACTIVE);
        $question->setCategory(new NullQACategory(1));
        $question->setCreatedBy(new NullAccount(1));
        $question->setLanguage('en');

        $id = QAQuestionMapper::create($question);
        self::assertGreaterThan(0, $question->getId());
        self::assertEquals($id, $question->getId());

        $questionR = QAQuestionMapper::get($question->getId());
        self::assertEquals($question->getName(), $questionR->getName());
        self::assertEquals($question->getQuestion(), $questionR->getQuestion());
        self::assertEquals($question->getStatus(), $questionR->getStatus());
        self::assertEquals($question->getLanguage(), $questionR->getLanguage());
        self::assertEquals($question->getCategory()->getId(), $questionR->getCategory()->getId());
        self::assertEquals($question->getCreatedBy()->getId(), $questionR->getCreatedBy()->getId());
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 30; ++$i) {
            $text     = new Text();
            $question = new QAQuestion();

            $question->setName($text->generateText(\mt_rand(1, 3)));
            $question->setQuestion($text->generateText(\mt_rand(100, 500)));
            $question->setStatus(QAQuestionStatus::ACTIVE);
            $question->setCategory(new NullQACategory(\mt_rand(1, 9)));
            $question->setCreatedBy(new NullAccount(1));
            $question->setLanguage('en');

            $id = QAQuestionMapper::create($question);
        }
    }
}
