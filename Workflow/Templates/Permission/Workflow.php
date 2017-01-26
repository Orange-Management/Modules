<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Media;

use Modules\Workflow\Models\WorkflowInterface;
use Modules\Workflow\Templates\Permission\States;
use phpOMS\DataStorage\Database\Connection\ConnectionAbstract;

/**
 * Media class.
 *
 * @category   Modules
 * @package    Modules\Media
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Workflow implements WorkflowInterface
{
    private $id = 0;
    private $state = 0;
    private $con = null;

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

    public function runRequest($data)
    {
        // todo: create workflow
        // todo: create task
        // todo: set state
    }

    public function runPending($data)
    {
        // todo: approve?!
        // todo: 
    }

    public function getState() : int
    {
        return $this->state;
    }
}