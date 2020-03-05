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

/**
 * @internal
 */
class KanbanCardCommentTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $comment = new KanbanCardComment();

        self::assertEquals(0, $comment->getId());
        self::assertEquals(0, $comment->getCard());
        self::assertEquals('', $comment->getDescription());
        self::assertEquals(0, $comment->getCreatedBy()->getId());
        self::assertInstanceOf('\DateTime', $comment->getCreatedAt());
        self::assertEquals([], $comment->getMedia());
    }

    public function testSetGet() : void
    {
        $comment = new KanbanCardComment();

        $comment->setCard(2);
        $comment->setDescription('Description');
        $comment->setCreatedBy(new NullAccount(1));
        $comment->addMedia(3);

        self::assertEquals(2, $comment->getCard());
        self::assertEquals('Description', $comment->getDescription());
        self::assertEquals(1, $comment->getCreatedBy()->getId());
        self::assertEquals([3], $comment->getMedia());
    }
}
