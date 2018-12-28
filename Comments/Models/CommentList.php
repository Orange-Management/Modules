<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Comments\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Comments\Models;

/**
 * Task class.
 *
 * @package    Modules\Comments\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class CommentList
{
    private $id = 0;

    private $comments = [];

    public function __construct()
    {
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getComments() : array
    {
        return $this->comments;
    }

    public function addComment($comment) : void
    {
        $this->comments[] = $comment;
    }
}
