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
use Modules\QA\Models\QAAnswerStatus;

/**
 * @internal
 */
class QAAnswerTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $answer = new QAAnswer();

        self::assertEquals(0, $answer->getId());
        self::assertEquals('', $answer->getAnswer());
        self::assertEquals(0, $answer->getQuestion()->getId());
        self::assertFalse($answer->isAccepted());
        self::assertEquals(QAAnswerStatus::ACTIVE, $answer->getStatus());
        self::assertEquals(0, $answer->getCreatedBy()->getId());
        self::assertInstanceOf('\DateTime', $answer->getCreatedAt());
    }

    public function testSetGet() : void
    {
        $answer = new QAAnswer();

        $answer->setAnswer('Answer content');
        $answer->setStatus(QAAnswerStatus::ACTIVE);
        $answer->setQuestion(new NullQAQuestion(3));
        $answer->setCreatedBy(new NullAccount(1));
        $answer->setAccepted(true);

        self::assertEquals('Answer content', $answer->getAnswer());
        self::assertEquals(QAAnswerStatus::ACTIVE, $answer->getStatus());
        self::assertEquals(1, $answer->getCreatedBy()->getId());
        self::assertEquals(3, $answer->getQuestion()->getId());
        self::assertTrue($answer->isAccepted());
    }
}
