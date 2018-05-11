<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Organization
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Organization;

use Model\Message\FormValidation;
use Modules\Organization\Models\Department;
use Modules\Organization\Models\DepartmentMapper;
use Modules\Organization\Models\Position;
use Modules\Organization\Models\PositionMapper;
use Modules\Organization\Models\Status;
use Modules\Organization\Models\Unit;
use Modules\Organization\Models\UnitMapper;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Utils\Parser\Markdown\Markdown;

use phpOMS\Account\PermissionType;
use Modules\Organization\Models\PermissionState;

/**
 * Organization Controller class.
 *
 * @package    Modules\Organization
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class Controller extends ModuleAbstract implements WebInterface
{

    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_NAME = 'Organization';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1004700000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewUnitList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::UNIT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Organization/Theme/Backend/unit-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004702001, $request, $response));

        $view->addData('list:elements', UnitMapper::getAll());

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewUnitProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::UNIT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Organization/Theme/Backend/unit-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004702001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\UnitTagSelector\UnitTagSelectorView($this->app, $request, $response);
        $view->addData('unit-selector', $selectorView);

        $view->addData('unit', UnitMapper::get((int) $request->getData('id')));

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewUnitCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::UNIT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Organization/Theme/Backend/unit-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004702001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\UnitTagSelector\UnitTagSelectorView($this->app, $request, $response);
        $view->addData('unit-selector', $selectorView);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewDepartmentList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DEPARTMENT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Organization/Theme/Backend/department-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004703001, $request, $response));

        $view->addData('list:elements', DepartmentMapper::getAll());

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewDepartmentProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DEPARTMENT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Organization/Theme/Backend/department-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004703001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\DepartmentTagSelector\DepartmentTagSelectorView($this->app, $request, $response);
        $view->addData('department-selector', $selectorView);

        $unitSelectorView = new \Modules\Organization\Theme\Backend\Components\UnitTagSelector\UnitTagSelectorView($this->app, $request, $response);
        $view->addData('unit-selector', $unitSelectorView);

        $view->addData('department', DepartmentMapper::get((int) $request->getData('id')));

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewDepartmentCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DEPARTMENT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Organization/Theme/Backend/department-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004703001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\DepartmentTagSelector\DepartmentTagSelectorView($this->app, $request, $response);
        $view->addData('department-selector', $selectorView);

        $unitSelectorView = new \Modules\Organization\Theme\Backend\Components\UnitTagSelector\UnitTagSelectorView($this->app, $request, $response);
        $view->addData('unit-selector', $unitSelectorView);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewPositionList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::POSITION)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Organization/Theme/Backend/position-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004704001, $request, $response));

        $view->addData('list:elements', PositionMapper::getAll());

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewPositionProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::POSITION)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Organization/Theme/Backend/position-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004704001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\PositionTagSelector\PositionTagSelectorView($this->app, $request, $response);
        $view->addData('position-selector', $selectorView);

        $departmentSelectorView = new \Modules\Organization\Theme\Backend\Components\DepartmentTagSelector\DepartmentTagSelectorView($this->app, $request, $response);
        $view->addData('department-selector', $departmentSelectorView);

        $view->addData('position', PositionMapper::get((int) $request->getData('id')));

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewPositionCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::POSITION)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Organization/Theme/Backend/position-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004704001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\PositionTagSelector\PositionTagSelectorView($this->app, $request, $response);
        $view->addData('position-selector', $selectorView);

        $departmentSelectorView = new \Modules\Organization\Theme\Backend\Components\DepartmentTagSelector\DepartmentTagSelectorView($this->app, $request, $response);
        $view->addData('department-selector', $departmentSelectorView);

        return $view;
    }

    /**
     * Validate unit create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     */
    private function validateUnitCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = empty($request->getData('name')))
            || ($val['parent'] = (
                !empty($request->getData('parent'))
                && !is_numeric($request->getData('parent'))
            ))
            || ($val['status'] = (
                $request->getData('status') === null
                || !Status::isValidValue((int) $request->getData('status'))
            ))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to get a unit
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiUnitGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::UNIT)
        ) {
            $response->set('unit_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $unit = UnitMapper::get((int) $request->getData('id'));
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Unit',
            'message' => 'Unit successfully returned.',
            'response' => $unit->jsonSerialize()
        ]);
    }

    /**
     * Api method to update a unit
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiUnitSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::UNIT)
        ) {
            $response->set('unit_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $unit = $this->updateUnitFromRequest($request);

        UnitMapper::update($unit);
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Unit',
            'message' => 'Unit successfully updated.',
            'response' => $unit->jsonSerialize()
        ]);
    }

    /**
     * Method to update unit from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Unit
     *
     * @since  1.0.0
     */
    private function updateUnitFromRequest(RequestAbstract $request) : Unit
    {
        $unit = UnitMapper::get((int) $request->getData('id'));
        $unit->setName((string) ($request->getData('name') ?? $unit->getName()));
        $unit->setDescriptionRaw((string) ($request->getData('description') ?? $unit->getDescriptionRaw()));
        $unit->setDescription(Markdown::parse((string) ($request->getData('description') ?? $unit->getDescriptionRaw())));

        $parent = (int) $request->getData('parent');
        $unit->setParent(!empty($parent) ? $parent : $unit->getParent());
        $unit->setStatus((int) ($request->getData('status') ?? $unit->getStatus()));

        return $unit;
    }

    /**
     * Api method to delete a unit
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiUnitDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::DELETE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::UNIT)
        ) {
            $response->set('unit_delete', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $unit   = UnitMapper::get((int) $request->getData('id'));
        $status = UnitMapper::delete($unit);

        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Unit',
            'message' => 'Unit successfully deleted.',
            'response' => $status
        ]);
    }

    /**
     * Api method to create a unit
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiUnitCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::UNIT)
        ) {
            $response->set('unit_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validateUnitCreate($request))) {
            $response->set('unit_create', new FormValidation($val));

            return;
        }

        $unit = $this->createUnitFromRequest($request);

        UnitMapper::create($unit);
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Unit',
            'message' => 'Unit successfully created.',
            'response' => $unit->jsonSerialize()
        ]);
    }

    /**
     * Method to create unit from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Unit
     *
     * @since  1.0.0
     */
    private function createUnitFromRequest(RequestAbstract $request) : Unit
    {
        $unit = new Unit();
        $unit->setName((string) $request->getData('name'));
        $unit->setDescriptionRaw((string) ($request->getData('description') ?? ''));
        $unit->setDescription(Markdown::parse((string) ($request->getData('description') ?? '')));

        $parent = (int) $request->getData('parent');
        $unit->setParent(!empty($parent) ? $parent : null);
        $unit->setStatus((int) $request->getData('status'));

        return $unit;
    }

    /**
     * Validate position create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     */
    private function validatePositionCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = empty($request->getData('name')))
            || ($val['parent'] = (
                !empty($request->getData('parent'))
                && !is_numeric($request->getData('parent'))
            ))
            || ($val['status'] = (
                $request->getData('status') === null
                || !Status::isValidValue((int) $request->getData('status'))
            ))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to get a position
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiPositionGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::POSITION)
        ) {
            $response->set('position_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $position = PositionMapper::get((int) $request->getData('id'));
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Position',
            'message' => 'Position successfully returned.',
            'response' => $position->jsonSerialize()
        ]);
    }

    /**
     * Api method to delete a position
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiPositionDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::DELETE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::POSITION)
        ) {
            $response->set('position_delete', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $position = PositionMapper::get((int) $request->getData('id'));
        $status   = PositionMapper::delete($position);

        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Position',
            'message' => 'Position successfully deleted.',
            'response' => $status
        ]);
    }

    /**
     * Api method to update a position
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiPositionSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::POSITION)
        ) {
            $response->set('position_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $position = $this->updatePositionFromRequest($request);

        PositionMapper::update($position);
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Position',
            'message' => 'Position successfully updated.',
            'response' => $position->jsonSerialize()
        ]);
    }

    /**
     * Method to update position from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Position
     *
     * @since  1.0.0
     */
    private function updatePositionFromRequest(RequestAbstract $request) : Position
    {
        $position = PositionMapper::get((int) $request->getData('id'));
        $position->setName((string) ($request->getData('name') ?? $position->getName()));
        $position->setDescriptionRaw((string) ($request->getData('description') ?? $position->getDescriptionRaw()));
        $position->setDescription(Markdown::parse((string) ($request->getData('description') ?? $position->getDescriptionRaw())));

        $parent = (int) $request->getData('parent');
        $position->setParent(!empty($parent) ? $parent : $position->getParent());

        $department = (int) $request->getData('department');
        $position->setDepartment(!empty($department) ? $department : $position->getDepartment());
        $position->setStatus((int) ($request->getData('status') ?? $position->getStatus()));

        return $position;
    }

    /**
     * Api method to create a position
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiPositionCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::POSITION)
        ) {
            $response->set('position_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validatePositionCreate($request))) {
            $response->set('position_create', new FormValidation($val));

            return;
        }

        $position = $this->createPositionFromRequest($request);

        PositionMapper::create($position);
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Position',
            'message' => 'Position successfully created.',
            'response' => $position->jsonSerialize()
        ]);
    }

    /**
     * Method to create position from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Position
     *
     * @since  1.0.0
     */
    private function createPositionFromRequest(RequestAbstract $request) : Position
    {
        $position = new Position();
        $position->setName((string) ($request->getData('name')));
        $position->setStatus((int) $request->getData('status'));
        $position->setDescriptionRaw((string) ($request->getData('description') ?? ''));
        $position->setDescription(Markdown::parse((string) ($request->getData('description') ?? '')));

        $parent = (int) $request->getData('parent');
        $position->setParent(!empty($parent) ? $parent : null);

        $department = (int) $request->getData('department');
        $position->setDepartment(!empty($department) ? $department : null);

        return $position;
    }

    /**
     * Method to validate department creation from request
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     */
    private function validateDepartmentCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = empty($request->getData('name')))
            || ($val['parent'] = (
                !empty($request->getData('parent'))
                && !is_numeric($request->getData('parent'))
            ))
            || ($val['unit'] = (
                !is_numeric((int) $request->getData('unit'))
            ))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to get a department
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiDepartmentGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DEPARTMENT)
        ) {
            $response->set('department_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $department = DepartmentMapper::get((int) $request->getData('id'));
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Department',
            'message' => 'Department successfully returned.',
            'response' => $department->jsonSerialize()
        ]);
    }

    /**
     * Api method to update a department
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiDepartmentSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DEPARTMENT)
        ) {
            $response->set('department_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $department = $this->updateDepartmentFromRequest($request);

        DepartmentMapper::update($department);

        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Department',
            'message' => 'Department successfully updated.',
            'response' => $department->jsonSerialize()
        ]);
    }

    /**
     * Method to update department from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Department
     *
     * @since  1.0.0
     */
    private function updateDepartmentFromRequest(RequestAbstract $request) : Department
    {
        $department = DepartmentMapper::get((int) $request->getData('id'));
        $department->setName((string) ($request->getData('name') ?? $department->getName()));
        $department->setDescriptionRaw((string) ($request->getData('description') ?? $department->getDescriptionRaw()));
        $department->setDescription(Markdown::parse((string) ($request->getData('description') ?? $department->getDescriptionRaw())));

        $parent = (int) $request->getData('parent');
        $department->setParent(!empty($parent) ? $parent : $department->getParent());
        $department->setStatus((int) ($request->getData('status') ?? $department->getStatus()));

        $unit = (int) $request->getData('unit');
        $department->setUnit(!empty($unit) ? $unit : $department->getUnit());

        return $department;
    }

    /**
     * Api method to delete a department
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiDepartmentDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::DELETE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DEPARTMENT)
        ) {
            $response->set('department_delete', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $department = DepartmentMapper::get((int) $request->getData('id'));
        $status     = DepartmentMapper::delete($department);

        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Department',
            'message' => 'Department successfully deleted.',
            'response' => $status
        ]);
    }

    /**
     * Api method to create a department
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiDepartmentCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_NAME, PermissionState::DEPARTMENT)
        ) {
            $response->set('department_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validateDepartmentCreate($request))) {
            $response->set('department_create', new FormValidation($val));

            return;
        }

        $department = $this->createDepartmentFromRequest($request);

        DepartmentMapper::create($department);
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Department',
            'message' => 'Department successfully created.',
            'response' => $department->jsonSerialize()
        ]);
    }

    /**
     * Method to create a department from a request
     *
     * @param RequestAbstract $request Request
     *
     * @return Department
     *
     * @since  1.0.0
     */
    private function createDepartmentFromRequest(RequestAbstract $request) : Department
    {
        $department = new Department();
        $department->setName((string) $request->getData('name'));
        $department->setStatus((int) $request->getData('status'));

        $parent = (int) $request->getData('parent');
        $department->setParent(!empty($parent) ? $parent : null);
        $department->setUnit((int) ($request->getData('unit') ?? 1));
        $department->setDescriptionRaw((string) ($request->getData('description') ?? ''));
        $department->setDescription(Markdown::parse((string) ($request->getData('description') ?? '')));

        return $department;
    }
}
