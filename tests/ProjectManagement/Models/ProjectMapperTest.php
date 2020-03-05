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

namespace Modules\tests\ProjectManagement\Models;

use Modules\Admin\Models\NullAccount;
use Modules\Media\Models\Media;
use Modules\ProjectManagement\Models\ProgressType;
use Modules\ProjectManagement\Models\Project;
use Modules\ProjectManagement\Models\ProjectMapper;
use Modules\Tasks\Models\Task;
use phpOMS\Localization\Money;
use phpOMS\Utils\RnG\Text;

/**
 * @internal
 */
class ProjectMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\ProjectManagement\Models\ProjectMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $project = new Project();

        $project->setName('Projectname');
        $project->setDescription('Description');
        $project->setCreatedBy(new NullAccount(1));
        $project->setStart(new \DateTime('2000-05-05'));
        $project->setEnd(new \DateTime('2005-05-05'));

        $money = new Money();
        $money->setString('1.23');

        $project->setCosts($money);
        $project->setBudgetCosts($money);
        $project->setBudgetEarnings($money);
        $project->setEarnings($money);

        $task = new Task();
        $task->setTitle('ProjectTask 1');
        $task->setCreatedBy(new NullAccount(1));

        $task2 = new Task();
        $task2->setTitle('ProjectTask 2');
        $task2->setCreatedBy(new NullAccount(1));

        $project->addTask($task);
        $project->addTask($task2);

        $project->setProgress(10);
        $project->setProgressType(ProgressType::TASKS);

        $media = new Media();
        $media->setCreatedBy(new NullAccount(1));
        $media->setDescription('desc');
        $media->setPath('some/path');
        $media->setSize(11);
        $media->setExtension('png');
        $media->setName('Project Media');
        $project->addMedia($media);

        $id = ProjectMapper::create($project);
        self::assertGreaterThan(0, $project->getId());
        self::assertEquals($id, $project->getId());

        $projectR = ProjectMapper::get($project->getId());

        self::assertEquals($project->getName(), $projectR->getName());
        self::assertEquals($project->getDescription(), $projectR->getDescription());
        self::assertEquals($project->countTasks(), $projectR->countTasks());
        self::assertEquals($project->getCosts()->getAmount(), $projectR->getCosts()->getAmount());
        self::assertEquals($project->getBudgetEarnings()->getAmount(), $projectR->getBudgetEarnings()->getAmount());
        self::assertEquals($project->getBudgetCosts()->getAmount(), $projectR->getBudgetCosts()->getAmount());
        self::assertEquals($project->getEarnings()->getAmount(), $projectR->getEarnings()->getAmount());
        self::assertEquals($project->getCreatedAt()->format('Y-m-d'), $projectR->getCreatedAt()->format('Y-m-d'));
        self::assertEquals($project->getStart()->format('Y-m-d'), $projectR->getStart()->format('Y-m-d'));
        self::assertEquals($project->getEnd()->format('Y-m-d'), $projectR->getEnd()->format('Y-m-d'));
        self::assertEquals($project->getProgress(), $projectR->getProgress());
        self::assertEquals($project->getProgressType(), $projectR->getProgressType());

        $expected = $project->getMedias();
        $actual   = $projectR->getMedias();

        self::assertEquals(\end($expected)->getName(), \end($actual)->getName());
    }

    public function testNewest() : void
    {
        $newest = ProjectMapper::getNewest(1);

        self::assertCount(1, $newest);
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 100; ++$i) {
            $text = new Text();

            $project = new Project();

            $project->setName($text->generateText(\mt_rand(3, 7)));
            $project->setDescription($text->generateText(\mt_rand(20, 100)));
            $project->setCreatedBy(new NullAccount(1));
            $project->setStart(new \DateTime('2000-05-05'));
            $project->setEnd(new \DateTime('2005-05-05'));
            $project->setProgress(\mt_rand(0, 100));
            $project->setProgressType(\mt_rand(0, 4));

            $money = new Money();
            $money->setString('1.23');

            $project->setCosts($money);
            $project->setBudgetCosts($money);
            $project->setBudgetEarnings($money);
            $project->setEarnings($money);

            $id = ProjectMapper::create($project);
        }
    }
}
