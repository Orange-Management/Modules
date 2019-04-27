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

/**
 * @internal
 */
class CommentListTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault() : void
    {
        $list = new CommentList();
        self::assertEquals(0, $list->getId());
        self::assertEquals([], $list->getComments());
    }

    public function testGetSet() : void
    {
        $list    = new CommentList();
        $comment = new Comment();
        $comment->setTitle('Test Comment');

        $list->addComment($comment);
        self::assertEquals('Test Comment', $list->getComments()[0]->getTitle());
    }
}
