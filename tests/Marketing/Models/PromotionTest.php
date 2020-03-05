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

namespace Modules\tests\Marketing\Models;

use Modules\Admin\Models\NullAccount;
use Modules\Marketing\Models\Promotion;
use Modules\Tasks\Models\Task;
use phpOMS\Localization\Money;

/**
 * @internal
 */
class PromotionTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $promotion = new Promotion();

        self::assertEquals(0, $promotion->getId());
        self::assertInstanceOf('\Modules\Calendar\Models\Calendar', $promotion->getCalendar());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $promotion->getCreatedAt()->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $promotion->getStart()->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->modify('+1 month')->format('Y-m-d'), $promotion->getEnd()->format('Y-m-d'));
        self::assertEquals(0, $promotion->getCreatedBy()->getId());
        self::assertEquals('', $promotion->getName());
        self::assertEquals('', $promotion->getDescription());
        self::assertEquals(0, $promotion->getCosts()->getInt());
        self::assertEquals(0, $promotion->getBudget()->getInt());
        self::assertEquals(0, $promotion->getEarnings()->getInt());
        self::assertEmpty($promotion->getTasks());
        self::assertFalse($promotion->removeTask(2));
        self::assertInstanceOf('\Modules\Tasks\Models\Task', $promotion->getTask(0));
    }

    public function testSetGet() : void
    {
        $promotion = new Promotion();

        $promotion->setName('Promotion');
        self::assertEquals('Promotion', $promotion->getName());

        $promotion->setDescription('Description');
        self::assertEquals('Description', $promotion->getDescription());

        $promotion->setStart($date = new \DateTime('2000-05-05'));
        self::assertEquals($date->format('Y-m-d'), $promotion->getStart()->format('Y-m-d'));

        $promotion->setEnd($date = new \DateTime('2000-05-05'));
        self::assertEquals($date->format('Y-m-d'), $promotion->getEnd()->format('Y-m-d'));

        $money = new Money();
        $money->setString('1.23');

        $promotion->setCosts($money);
        self::assertEquals($money->getAmount(), $promotion->getCosts()->getAmount());

        $promotion->setBudget($money);
        self::assertEquals($money->getAmount(), $promotion->getBudget()->getAmount());

        $promotion->setEarnings($money);
        self::assertEquals($money->getAmount(), $promotion->getEarnings()->getAmount());

        $task = new Task();
        $task->setTitle('Promo Task A');
        $task->setCreatedBy(new NullAccount(1));

        $promotion->addTask($task);

        self::assertEquals('Promo Task A', $promotion->getTask(0)->getTitle());
        self::assertCount(1, $promotion->getTasks());
        self::assertTrue($promotion->removeTask(0));
        self::assertEquals(0, $promotion->countTasks());
    }
}
