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
use Modules\QA\Models\QAQuestionStatus;

/**
 * @internal
 */
class QAQuestionTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $question = new QAQuestion();

        self::assertEquals(0, $question->getId());
        self::assertEquals('', $question->getName());
        self::assertEquals('', $question->getQuestion());
        self::assertEquals(QAQuestionStatus::ACTIVE, $question->getStatus());
        self::assertEquals(0, $question->getCategory()->getId());
        self::assertEquals('', $question->getLanguage());
        self::assertEquals(0, $question->getCreatedBy()->getId());
        self::assertInstanceOf('\DateTime', $question->getCreatedAt());
        self::assertEquals([], $question->getBadges());
    }

    public function testSetGet() : void
    {
        $question = new QAQuestion();

        $question->setName('Question Name');
        $question->setQuestion('Question content');
        $question->setStatus(QAQuestionStatus::ACTIVE);
        $question->setCategory(new NullQACategory(1));
        $question->setCreatedBy(new NullAccount(1));
        $question->setLanguage('en');

        self::assertEquals('Question Name', $question->getName());
        self::assertEquals('Question content', $question->getQuestion());
        self::assertEquals(QAQuestionStatus::ACTIVE, $question->getStatus());
        self::assertEquals('en', $question->getLanguage());
        self::assertEquals(1, $question->getCategory()->getId());
        self::assertEquals(1, $question->getCreatedBy()->getId());
    }
}
