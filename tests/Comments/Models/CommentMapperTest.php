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

namespace Modules\tests\Comments\Models;

use Modules\Admin\Models\NullAccount;
use Modules\Comments\Models\Comment;
use Modules\Comments\Models\CommentMapper;

/**
 * @internal
 */
class CommentMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
        $comment = new Comment();
        $comment->setCreatedBy(new NullAccount(1));
        $comment->setTitle('Test Title');
        $comment->setContent('Test Content');
        $comment->setRef(1);
        $comment->setList(1);

        $id = CommentMapper::create($comment);
        self::assertGreaterThan(0, $comment->getId());
        self::assertEquals($id, $comment->getId());

        $commentR = CommentMapper::get($comment->getId());
        self::assertEquals($id, $commentR->getId());
        self::assertEquals($comment->getCreatedBy()->getId(), $commentR->getCreatedBy()->getId());
        self::assertEquals($comment->getTitle(), $commentR->getTitle());
        self::assertEquals($comment->getContent(), $commentR->getContent());
        self::assertEquals($comment->getRef(), $commentR->getRef());
        self::assertEquals($comment->getList(), $commentR->getList());
    }
}
