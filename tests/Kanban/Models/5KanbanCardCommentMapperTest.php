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

namespace Modules\tests\Kanban\Models;

use Modules\Admin\Models\NullAccount;
use Modules\Kanban\Models\KanbanCardComment;
use Modules\Kanban\Models\KanbanCardCommentMapper;
use phpOMS\Utils\RnG\Text;

/**
 * @internal
 */
class KanbanCardCommentMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $comment = new KanbanCardComment();

        $comment->setDescription('This is some card description');
        $comment->setCard(1);
        $comment->setCreatedBy(new NullAccount(1));

        $id = KanbanCardCommentMapper::create($comment);
        self::assertGreaterThan(0, $comment->getId());
        self::assertEquals($id, $comment->getId());

        $commentR = KanbanCardCommentMapper::get($comment->getId());
        self::assertEquals($comment->getDescription(), $commentR->getDescription());
        self::assertEquals($comment->getCard(), $commentR->getCard());
        self::assertEquals($comment->getCreatedBy()->getId(), $commentR->getCreatedBy()->getId());
        self::assertEquals($comment->getCreatedAt()->format('Y-m-d'), $commentR->getCreatedAt()->format('Y-m-d'));
    }

    /**
     * @group volume
     * @group module
     * @coversNothing
     */
    public function testVolume() : void
    {
        for ($i = 1; $i < 10; ++$i) {
            $text    = new Text();
            $comment = new KanbanCardComment();

            $comment->setDescription($text->generateText(\mt_rand(20, 100)));
            $comment->setCard(1);
            $comment->setCreatedBy(new NullAccount(1));

            $id = KanbanCardCommentMapper::create($comment);
        }
    }
}
