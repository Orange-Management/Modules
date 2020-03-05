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
use Modules\QA\Models\NullQAQuestion;
use Modules\QA\Models\QAAnswer;
use Modules\QA\Models\QAAnswerMapper;
use Modules\QA\Models\QAAnswerStatus;
use phpOMS\Utils\RnG\Text;

/**
 * @internal
 */
class QAAnswerMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $answer = new QAAnswer();

        $answer->setAnswer('Answer content');
        $answer->setStatus(QAAnswerStatus::ACTIVE);
        $answer->setCreatedBy(new NullAccount(1));
        $answer->setQuestion(new NullQAQuestion(1));
        $answer->setAccepted(true);

        $id = QAAnswerMapper::create($answer);
        self::assertGreaterThan(0, $answer->getId());
        self::assertEquals($id, $answer->getId());

        $answerR = QAAnswerMapper::get($answer->getId());
        self::assertEquals($answer->getAnswer(), $answerR->getAnswer());
        self::assertEquals($answer->getQuestion()->getId(), $answerR->getQuestion()->getId());
        self::assertEquals($answer->getStatus(), $answerR->getStatus());
        self::assertEquals($answer->isAccepted(), $answerR->isAccepted());
        self::assertEquals($answer->getCreatedBy()->getId(), $answerR->getCreatedBy()->getId());
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 30; ++$i) {
            $text   = new Text();
            $answer = new QAAnswer();

            $answer->setAnswer($text->generateText(\mt_rand(100, 500)));
            $answer->setCreatedBy(new NullAccount(1));
            $answer->setStatus(QAAnswerStatus::ACTIVE);
            $answer->setQuestion(new NullQAQuestion(1));

            $id = QAAnswerMapper::create($answer);
        }
    }
}
