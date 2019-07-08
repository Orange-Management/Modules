<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Workflow
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Workflow\Templates\Permission;

use Modules\Workflow\Models\WorkflowInterface;
use phpOMS\DataStorage\Database\Connection\ConnectionAbstract;

/**
 * Workflow class.
 *
 * @package    Modules\Workflow
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
class Workflow implements WorkflowInterface
{
    private $id    = 0;
    private $state = 0;
    private $con   = null;

    public function __construct(ConnectionAbstract $con)
    {
        $this->con = $con;
    }

    public function run($data) : int
    {
        switch ($this->state) {
            case States::DEFAULT:
                $this->state = $this->runRequest($data);
                break;
            case States::PENDING:
                $this->state = $this->runPending($data);
                break;
            default:
        }

        return $this->state;
    }

    public function runRequest($data) : int
    {
        // todo: create workflow
        // todo: create task
        // todo: set state

        return 0;
    }

    public function runPending($data) : int
    {
        // todo: approve?!
        // todo:

        return 0;
    }

    public function getState() : int
    {
        return $this->state;
    }
}
