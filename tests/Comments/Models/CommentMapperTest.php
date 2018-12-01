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

namespace Modules\tests\Comments\Models;

use Modules\Comments\Models\Comment;
use Modules\Comments\Models\CommentMapper;

class CommentMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD()
    {
        $comment = new Comment();
        $comment->setCreatedBy(1);
        $comment->setTitle('Test Title');
        $comment->setContent('Test Content');
        $comment->setRef(1);
        $comment->setList(1);

        $id = CommentMapper::create($comment);
        self::assertGreaterThan(0, $comment->getId());
        self::assertEquals($id, $comment->getId());

        $commentR = CommentMapper::get($comment->getId());
        self::assertEquals($id, $commentR->getId());
        self::assertEquals($comment->getCreatedBy(), $commentR->getCreatedBy());
        self::assertEquals($comment->getTitle(), $commentR->getTitle());
        self::assertEquals($comment->getContent(), $commentR->getContent());
        self::assertEquals($comment->getRef(), $commentR->getRef());
        self::assertEquals($comment->getList(), $commentR->getList());
    }
}
