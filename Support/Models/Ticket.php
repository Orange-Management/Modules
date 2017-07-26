<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\Support;

use Modules\Tasks\Models\Task;

/**
 * Issue class.
 *
 * @category   Support
 * @package    Framework
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Ticket extends Task
{

    private $id   = 0;
    private $task = 0;

    /**
     * Assigned group.
     *
     * @var int
     * @since 1.0.0
     */
    private $group = 0;

    /**
     * Assigned person.
     *
     * @var int
     * @since 1.0.0
     */
    private $person = 0;

    public function __construct()
    {
        parent::__construct();
    }

}
