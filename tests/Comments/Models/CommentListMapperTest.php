<?php declare(strict_types=1);
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
use Modules\Comments\Models\CommentList;
use Modules\Comments\Models\CommentListMapper;

/**
 * @internal
 */
class CommentListMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testCRUD() : void
    {
        $list = new CommentList();

        $comment = new Comment();
        $comment->setCreatedBy(1);
        $comment->setTitle('Test Comment');

        $list->addComment($comment);

        $id = CommentListMapper::create($list);
        self::assertGreaterThan(0, $list->getId());
        self::assertEquals($id, $list->getId());

        $listR = CommentListMapper::get($list->getId());
        self::assertEquals($id, $listR->getId());

        $actual = $listR->getComments();
        self::assertEquals($comment->getTitle(), \reset($actual)->getTitle());
    }
}
