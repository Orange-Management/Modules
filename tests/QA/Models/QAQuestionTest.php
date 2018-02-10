<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\QA\Models;

use Modules\QA\Models\QAQuestion;
use Modules\QA\Models\QAQuestionStatus;
use Modules\QA\Models\QABadge;

class QAQuestionTest extends \PHPUnit\Framework\TestCase
{
    public function testDefult()
    {
        $question = new QAQuestion();

        self::assertEquals(0, $question->getId());
        self::assertEquals('', $question->getName());
        self::assertEquals('', $question->getQuestion());
        self::assertEquals(QAQuestionStatus::ACTIVE, $question->getStatus());
        self::assertEquals(0, $question->getCategory());
        self::assertEquals('', $question->getLanguage());
        self::assertEquals(0, $question->getCreatedBy());
        self::assertInstanceOf('\DateTime', $question->getCreatedAt());
        self::assertEquals([], $question->getBadges());
    }

    public function testSetGet()
    {
        $question = new QAQuestion();

        $question->setName('Question Name');
        $question->setQuestion('Question content');
        $question->setStatus(QAQuestionStatus::ACTIVE);
        $question->setCategory(1);
        $question->setCreatedBy(2);
        $question->setLanguage('en');
        $question->addBadge(new QABadge());

        self::assertEquals('Question Name', $question->getName());
        self::assertEquals('Question content', $question->getQuestion());
        self::assertEquals(QAQuestionStatus::ACTIVE, $question->getStatus());
        self::assertEquals('en', $question->getLanguage());
        self::assertEquals(1, $question->getCategory());
        self::assertEquals(2, $question->getCreatedBy());
        self::assertEquals([new QABadge()], $question->getBadges());
    }
}