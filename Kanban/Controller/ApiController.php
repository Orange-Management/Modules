<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Kanban
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Kanban\Controller;

use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Asset\AssetType;
use phpOMS\Account\PermissionType;
use phpOMS\Message\Http\RequestStatusCode;

use Modules\Kanban\Models\PermissionState;
use Modules\Kanban\Models\KanbanBoard;
use Modules\Kanban\Models\KanbanBoardMapper;
use Modules\Kanban\Models\KanbanLabel;
use Modules\Kanban\Models\KanbanLabelMapper;
use Modules\Kanban\Models\KanbanColumn;
use Modules\Kanban\Models\KanbanColumnMapper;
use Modules\Kanban\Models\KanbanCard;
use Modules\Kanban\Models\KanbanCardMapper;
use Modules\Kanban\Models\KanbanCardComment;
use Modules\Kanban\Models\KanbanCardCommentMapper;
use Modules\Kanban\Models\CardStatus;
use Modules\Kanban\Models\CardType;
use Modules\Kanban\Models\BoardStatus;

/**
 * Task class.
 *
 * @package    Modules\Kanban
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class ApiController extends Controller
{
    public function apiKanbanCardCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateKanbanCardCreate($request))) {
            $response->set('kanban_card_create', new FormValidation($val));

            return;
        }

        $card = $this->createKanbanCardFromRquest($request);
        KanbanCardMapper::create($card);
        $response->set('card', $card->jsonSerialize());
    }

    public function createKanbanCardFromRquest(RequestAbstract $request) : KanbanCard
    {
        $mardkownParser = new Markdown();

        $card = new KanbanCard();
        $card->setName((string) ($request->getData('title')));
        $card->setDescription((string) ($request->getData('plain')));
        $card->setColumn((int) $request->getData('column'));
        $card->setOrder((int) $request->getData('order'));
        $card->setRef((int) $request->getData('ref'));
        $card->setLabels((array) $request->getData('labels'));
        $card->setStatus((int) $request->getData('status'));
        $card->setType((int) $request->getData('type'));

        return $card;
    }

    private function validateKanbanCardCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['plain'] = empty($request->getData('plain')))
            || ($val['column'] = empty($request->getData('column')))
            || ($val['order'] = empty($request->getData('order')))
            || ($val['ref'] = empty($request->getData('ref')))
            || ($val['labels'] = empty($request->getData('labels')))
            || ($val['status'] = (
                $request->getData('status') !== null
                && !CardStatus::isValidValue((int) $request->getData('status'))
            ))
            || ($val['type'] = (
                $request->getData('type') === null
                || !CardType::isValidValue((int) $request->getData('type'))
            ))
        ) {
            return $val;
        }

        return [];
    }

    public function apiKanbanBoardCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateKanbanBoardCreate($request))) {
            $response->set('kanban_board_create', new FormValidation($val));

            return;
        }

        $board = $this->createKanbanBoardFromRquest($request);
        KanbanBoardMapper::create($board);
        $response->set('board', $board->jsonSerialize());
    }

    public function createKanbanBoardFromRquest(RequestAbstract $request) : KanbanBoard
    {
        $mardkownParser = new Markdown();

        $board = new KanbanBoard();
        $board->setName((string) $request->getData('title'));
        $board->setDescription((string) $request->getData('plain'));
        $board->setOrder((int) $request->getData('order'));
        $board->setStatus((int) $request->getData('status'));

        return $board;
    }

    private function validateKanbanBoardCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['plain'] = empty($request->getData('plain')))
            || ($val['order'] = empty($request->getData('order')))
            || ($val['status'] = (
                $request->getData('status') !== null
                && !CardStatus::isValidValue((int) $request->getData('status'))
            ))
        ) {
            return $val;
        }

        return [];
    }

    public function apiKanbanColumnCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateKanbanColumnCreate($request))) {
            $response->set('kanban_column_create', new FormValidation($val));

            return;
        }

        $column = $this->createKanbanColumnFromRquest($request);
        KanbanColumnMapper::create($column);
        $response->set('column', $column->jsonSerialize());
    }

    public function createKanbanColumnFromRquest(RequestAbstract $request) : KanbanColumn
    {
        $mardkownParser = new Markdown();

        $column = new KanbanColumn();
        $column->setName((string) $request->getData('title'));
        $column->setOrder((int) $request->getData('order'));

        return $column;
    }

    private function validateKanbanColumnCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['order'] = empty($request->getData('order')))
        ) {
            return $val;
        }

        return [];
    }

    public function apiKanbanLabelCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $account = $this->app->accountManager->get($request->getHeader()->getAccount());

        if (!$account->hasPermission(PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::BOARD)
            && !$account->hasPermission(PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::LABEL)
        ) {
            $response->set('kanban_label_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validateKanbanLabelCreate($request))) {
            $response->set('kanban_label_create', new FormValidation($val));

            return;
        }

        $label = $this->createKanbanLabelFromRquest($request);
        KanbanLabelMapper::create($label);
        $response->set('label', $label->jsonSerialize());
    }

    public function createKanbanLabelFromRquest(RequestAbstract $request) : KanbanLabel
    {
        $label = new KanbanLabel();
        $label->setName($request->getData('title'));
        $label->setBoard((int) $request->getData('board'));
        $label->setcolor((int) $request->getData('color'));

        return $label;
    }

    private function validateKanbanLabelCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['board'] = empty($request->getData('board')))
            || ($val['color'] = empty($request->getData('color')))
        ) {
            return $val;
        }

        return [];
    }
}
