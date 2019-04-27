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
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\QA\Models;

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
        $answer->setCreatedBy(1);
        $answer->setQuestion(1);
        $answer->setAccepted(true);

        $id = QAAnswerMapper::create($answer);
        self::assertGreaterThan(0, $answer->getId());
        self::assertEquals($id, $answer->getId());

        $answerR = QAAnswerMapper::get($answer->getId());
        self::assertEquals($answer->getAnswer(), $answerR->getAnswer());
        self::assertEquals($answer->getQuestion(), $answerR->getQuestion());
        self::assertEquals($answer->getStatus(), $answerR->getStatus());
        self::assertEquals($answer->isAccepted(), $answerR->isAccepted());
        self::assertEquals($answer->getCreatedBy(), $answerR->getCreatedBy()->getId());
    }

    /**
     * @group volume
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 30; ++$i) {
            $text   = new Text();
            $answer = new QAAnswer();

            $answer->setAnswer($text->generateText(\mt_rand(100, 500)));
            $answer->setCreatedBy(1);
            $answer->setStatus(QAAnswerStatus::ACTIVE);
            $answer->setQuestion(1);

            $id = QAAnswerMapper::create($answer);
        }
    }
}
