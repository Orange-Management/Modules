<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Dashboard
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Dashboard\Controller;

use Modules\Dashboard\Models\DashboardBoard;
use Modules\Dashboard\Models\DashboardBoardMapper;
use Modules\Dashboard\Models\DashboardBoardStatus;
use Modules\Dashboard\Models\DashboardComponent;
use Modules\Dashboard\Models\DashboardComponentMapper;
use phpOMS\Message\NotificationLevel;

use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;

/**
 * Api controller for the dashboard module.
 *
 * @package Modules\Dashboard
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#12
 *  Dynamic providing should be handled in the DB
 *  Providing for the dashboard is dynamic and can be customized by the user himself.
 *  Hence the loading of the plugins should be handled in the module manager and database.
 *  Module specific providing could remain the same? Maybe even create a dashboard table just for this like the navigation module.
 *  This way modules can tell the dashboard that there is a plugin it can use.
 *  In this table it also should be possible to specify additional information.
 */
final class ApiController extends Controller
{
    /**
     * Validate board create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateBoardCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a board
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiBoardCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateBoardCreate($request))) {
            $response->set($request->getUri()->__toString(), new FormValidation($val));

            return;
        }

        $board = $this->createBoardFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $board, DashboardBoardMapper::class, 'board');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Board', 'Board successfully created.', $board);
    }

    /**
     * Method to create board from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return DashboardBoard Returns the created board from the request
     *
     * @since 1.0.0
     */
    private function createBoardFromRequest(RequestAbstract $request) : DashboardBoard
    {
        $board = new DashboardBoard();
        $board->setTitle((string) ($request->getData('title') ?? ''));
        $board->setAccount($request->getHeader()->getAccount());
        $board->setStatus(DashboardBoardStatus::ACTIVE);

        return $board;
    }

    /**
     * Validate component create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateComponentCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['board'] = empty($request->getData('board')))
            || ($val['module'] = empty($request->getData('module')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a component
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiComponentCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateComponentCreate($request))) {
            $response->set($request->getUri()->__toString(), new FormValidation($val));

            return;
        }

        $component = $this->createComponentFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $component, DashboardComponentMapper::class, 'component');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Component', 'Component successfully created.', $component);
    }

    /**
     * Method to create board from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return DashboardComponent Returns the created board from the request
     *
     * @since 1.0.0
     */
    private function createComponentFromRequest(RequestAbstract $request) : DashboardComponent
    {
        $component = new DashboardComponent();
        $component->setBoard((int) ($request->getData('board') ?? 0));
        $component->setOrder((int) ($request->getData('order') ?? 0));
        $component->setModule((string) ($request->getData('module') ?? ''));

        return $component;
    }

    /**
     * Api method to create a board
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiComponentAdd(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {

    }
}
