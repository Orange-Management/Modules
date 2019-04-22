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

namespace Modules\tests\Tasks\Models;

use Modules\Media\Models\Media;
use Modules\Tasks\Models\Task;
use Modules\Tasks\Models\TaskElement;
use Modules\Tasks\Models\TaskMapper;
use Modules\Tasks\Models\TaskPriority;
use Modules\Tasks\Models\TaskStatus;
use phpOMS\Utils\RnG\Text;
use phpOMS\DataStorage\Database\RelationType;

class TaskMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testDefault() : void
    {
        self::assertEquals([], TaskMapper::getOpenCreatedBy(999));
        self::assertEquals(0, TaskMapper::countUnread(999));
    }

    public function testCRUD() : void
    {
        $task = new Task();

        $task->setCreatedBy(1);
        $task->getSchedule()->setCreatedBy(1);
        $task->setStart(new \DateTime('2005-05-05'));
        $task->setTitle('Task Test');
        $task->setStatus(TaskStatus::DONE);
        $task->setClosable(false);
        $task->setPriority(TaskPriority::HIGH);
        $task->setDescription('Description');
        $task->setDescriptionRaw('DescriptionRaw');
        $task->setDone(new \DateTime('2000-05-06'));
        $task->setDue(new \DateTime('2000-05-05'));

        $taskElement1 = new TaskElement();
        $taskElement1->setDescription('Desc1');
        $taskElement1->setCreatedBy(1);
        $taskElement1->setStatus($task->getStatus());
        $task->addElement($taskElement1);

        $media = new Media();
        $media->setCreatedBy(1);
        $media->setDescription('desc');
        $media->setPath('some/path');
        $media->setSize(11);
        $media->setExtension('png');
        $media->setName('Task Element Media');
        $taskElement1->addMedia($media);

        $taskElement2 = new TaskElement();
        $taskElement2->setDescription('Desc2');
        $taskElement2->setCreatedBy(1);
        $taskElement2->setStatus($task->getStatus());
        $taskElement2->addAccountTo(1);
        $taskElement2->addAccountCC(1);
        $taskElement2->addGroupTo(1);
        $taskElement2->addGroupCC(1);
        $task->addElement($taskElement2);

        $media = new Media();
        $media->setCreatedBy(1);
        $media->setDescription('desc');
        $media->setPath('some/path');
        $media->setSize(11);
        $media->setExtension('png');
        $media->setName('Task Media');
        $task->addMedia($media);

        $id = TaskMapper::create($task);
        self::assertGreaterThan(0, $task->getId());
        self::assertEquals($id, $task->getId());

        $taskR = TaskMapper::get($task->getId());
        self::assertEquals($task->getCreatedAt()->format('Y-m-d'), $taskR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($task->getStart()->format('Y-m-d'), $taskR->getStart()->format('Y-m-d'));
        self::assertEquals($task->getCreatedBy(), $taskR->getCreatedBy()->getId());
        self::assertEquals($task->getDescription(), $taskR->getDescription());
        self::assertEquals($task->getDescriptionRaw(), $taskR->getDescriptionRaw());
        self::assertEquals($task->getTitle(), $taskR->getTitle());
        self::assertEquals($task->getStatus(), $taskR->getStatus());
        self::assertEquals($task->isClosable(), $taskR->isClosable());
        self::assertEquals($task->getType(), $taskR->getType());
        self::assertEquals($task->getDone()->format('Y-m-d'), $taskR->getDone()->format('Y-m-d'));
        self::assertEquals($task->getDue()->format('Y-m-d'), $taskR->getDue()->format('Y-m-d'));
        self::assertGreaterThan(0, TaskMapper::countUnread(1));

        $expected = $task->getMedia();
        $actual   = $taskR->getMedia();
        self::assertEquals(end($expected)->getName(), end($actual)->getName());

        $expected = $task->getTaskElements();
        $actual   = $taskR->getTaskElements();

        $expectedMedia = \reset($expected)->getMedia();
        $actualMedia   = \reset($actual)->getMedia();

        self::assertEquals(end($expected)->getDescription(), end($actual)->getDescription());
        self::assertEquals(end($expectedMedia)->getName(), end($actualMedia)->getName());

        self::assertTrue(end($actual)->isToAccount(1));
        self::assertTrue(end($actual)->isToGroup(1));
        self::assertTrue(end($actual)->isCCAccount(1));
        self::assertTrue(end($actual)->isCCGroup(1));

        self::assertEquals(2, \count(end($actual)->getTo()));
        self::assertEquals(2, \count(end($actual)->getCC()));
    }

    public function testNewest() : void
    {
        $newest = TaskMapper::getNewest(1);

        self::assertEquals(1, \count($newest));
    }

    /**
     * @group volume
     */
    public function testCreatedByMeForMe() : void
    {
        $text = new Text();

        $taskStatus = TaskStatus::getConstants();

        foreach ($taskStatus as $status) {
            $task = new Task();

            $task->setCreatedBy(1);
            $task->getSchedule()->setCreatedBy(1);
            $task->setStart(new \DateTime('2005-05-05'));
            $task->setTitle($text->generateText(mt_rand(1, 5)));
            $task->setStatus($status);
            $task->setDescription($text->generateText(mt_rand(10, 30)));
            $task->setDone(new \DateTime('2000-05-06'));
            $task->setDue(new \DateTime('2000-05-05'));

            $taskElement1 = new TaskElement();
            $taskElement1->setDescription($text->generateText(mt_rand(3, 20)));
            $taskElement1->setCreatedBy(1);
            $taskElement1->setStatus($status);
            $task->addElement($taskElement1);

            $taskElement2 = new TaskElement();
            $taskElement2->setDescription('Desc2');
            $taskElement2->setCreatedBy(1);
            $taskElement2->setStatus($status);
            $task->addElement($taskElement2);

            $id = TaskMapper::create($task);
        }

        self::assertGreaterThan(0, TaskMapper::countUnread(1));
    }

    /**
     * @group volume
     */
    public function testCreatedByMeForOther() : void
    {
        $text = new Text();

        $taskStatus = TaskStatus::getConstants();

        foreach ($taskStatus as $status) {
            $task = new Task();

            $task->setCreatedBy(1);
            $task->getSchedule()->setCreatedBy(1);
            $task->setTitle($text->generateText(mt_rand(1, 5)));
            $task->setStatus($status);
            $task->setClosable(true);
            $task->setDescription($text->generateText(mt_rand(10, 30)));
            $task->setDone(new \DateTime('2000-05-06'));
            $task->setDue(new \DateTime('2000-05-05'));

            $taskElement1 = new TaskElement();
            $taskElement1->setDescription($text->generateText(mt_rand(3, 20)));
            $taskElement1->setCreatedBy(1);
            $taskElement1->setStatus($status);
            $task->addElement($taskElement1);

            $taskElement2 = new TaskElement();
            $taskElement2->setDescription($text->generateText(mt_rand(3, 20)));
            $taskElement2->setCreatedBy(1);
            $taskElement2->setStatus($status);
            $task->addElement($taskElement2);

            $id = TaskMapper::create($task);
        }
    }

    /**
     * @group volume
     */
    public function testCreatedByOtherForMe() : void
    {
        $text = new Text();

        $taskStatus = TaskStatus::getConstants();

        foreach ($taskStatus as $status) {
            $task = new Task();

            $task->setCreatedBy(1);
            $task->getSchedule()->setCreatedBy(1);
            $task->setTitle($text->generateText(mt_rand(1, 5)));
            $task->setStatus($status);
            $task->setClosable(true);
            $task->setDescription($text->generateText(mt_rand(10, 30)));
            $task->setDone(new \DateTime('2000-05-06'));
            $task->setDue(new \DateTime('2000-05-05'));

            $taskElement1 = new TaskElement();
            $taskElement1->setDescription($text->generateText(mt_rand(3, 20)));
            $taskElement1->setCreatedBy(1);
            $taskElement1->setStatus($status);
            $task->addElement($taskElement1);

            $taskElement2 = new TaskElement();
            $taskElement2->setDescription($text->generateText(mt_rand(3, 20)));
            $taskElement2->setCreatedBy(1);
            $taskElement2->setStatus($status);
            $task->addElement($taskElement2);

            $id = TaskMapper::create($task);
        }
    }
}
