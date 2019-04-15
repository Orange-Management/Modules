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

namespace Modules\tests\QA\Models;

use Modules\QA\Models\QAAnswer;
use Modules\QA\Models\QAAnswerStatus;

class QAAnswerTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $answer = new QAAnswer();

        self::assertEquals(0, $answer->getId());
        self::assertEquals('', $answer->getAnswer());
        self::assertEquals(0, $answer->getQuestion());
        self::assertEquals(false, $answer->isAccepted());
        self::assertEquals(QAAnswerStatus::ACTIVE, $answer->getStatus());
        self::assertEquals(0, $answer->getCreatedBy());
        self::assertInstanceOf('\DateTime', $answer->getCreatedAt());
    }

    public function testSetGet() : void
    {
        $answer = new QAAnswer();

        $answer->setAnswer('Answer content');
        $answer->setStatus(QAAnswerStatus::ACTIVE);
        $answer->setQuestion(3);
        $answer->setCreatedBy(1);
        $answer->setAccepted(true);

        self::assertEquals('Answer content', $answer->getAnswer());
        self::assertEquals(QAAnswerStatus::ACTIVE, $answer->getStatus());
        self::assertEquals(1, $answer->getCreatedBy());
        self::assertEquals(3, $answer->getQuestion());
        self::assertEquals(true, $answer->isAccepted());
    }
}
