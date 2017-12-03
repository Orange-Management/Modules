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
 * @link       http://website.orange-management.de
 */
declare(strict_types = 1);
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

use phpOMS\Account\PermissionType;
use Modules\Organization\Models\PermissionState;

/**
 * Organization Controller class.
 *
 * @category   Modules
 * @package    Modules\Organization
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Controller extends ModuleAbstract implements WebInterface
{

    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    /* public */ const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    /* public */ const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    /* public */ const MODULE_NAME = 'Organization';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    /* public */ const MODULE_ID = 1004700000;

    /**
     * Providing.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var string
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
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::UNIT)
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
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::UNIT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }
        
        $view->setTemplate('/Modules/Organization/Theme/Backend/unit-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004702001, $request, $response));

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
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::UNIT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }
        
        $view->setTemplate('/Modules/Organization/Theme/Backend/unit-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004702001, $request, $response));

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
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::DEPARTMENT)
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
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::DEPARTMENT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }
        
        $view->setTemplate('/Modules/Organization/Theme/Backend/department-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004703001, $request, $response));

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
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::DEPARTMENT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }
        
        $view->setTemplate('/Modules/Organization/Theme/Backend/department-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004703001, $request, $response));

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
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::POSITION)
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
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::POSITION)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }
        
        $view->setTemplate('/Modules/Organization/Theme/Backend/position-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004704001, $request, $response));

        $view->addData($request->__toString(), PositionMapper::get((int) $request->getData('id')));

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
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::POSITION)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }
        
        $view->setTemplate('/Modules/Organization/Theme/Backend/position-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004704001, $request, $response));

        return $view;
    }

    private function validateUnitCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (
            ($val['name'] = empty($request->getData('name')))
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

    public function apiUnitGet(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::UNIT)
        ) {
            $response->set('unit_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }
        
        $unit = UnitMapper::get((int) $request->getData('id'));
        $response->set($request->__toString(), $unit->jsonSerialize());
    }

    public function apiUnitSet(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::UNIT)
        ) {
            $response->set('unit_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }
        
        $unit = UnitMapper::get((int) $request->getData('id'));

        $unit->setName((string) ($request->getData('name') ?? $unit->getName()));
        $unit->setDescription((string) ($request->getData('description') ?? $unit->getDescription()));
        
        $parent = (int) $request->getData('parent');
        $unit->setParent(!empty($parent) ? $parent : $unit->getParent());
        $unit->setStatus((int) ($request->getData('status') ?? $unit->getStatus()));

        UnitMapper::update($unit);

        $response->set($request->__toString(), $unit->jsonSerialize());
    }

    public function apiUnitDelete(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::DELETE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::UNIT)
        ) {
            $response->set('unit_delete', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }
        
        $unit = UnitMapper::get((int) $request->getData('id'));
        $status = UnitMapper::delete($unit);

        $response->set($request->__toString(), $status);
    }

    public function apiUnitCreate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::UNIT)
        ) {
            $response->set('unit_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }
        
        if (!empty($val = $this->validateUnitCreate($request))) {
            $response->set('unit_create', new FormValidation($val));

            return;
        }

        $unit = new Unit();
        $unit->setName((string) $request->getData('name'));
        $unit->setDescription((string) ($request->getData('description') ?? ''));
        
        $parent = (int) $request->getData('parent');
        $unit->setParent(!empty($parent) ? $parent : null);
        $unit->setStatus((int) $request->getData('status'));

        UnitMapper::create($unit);

        $response->set($request->__toString(), $unit->jsonSerialize());
    }

    private function validatePositionCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (
            ($val['name'] = empty($request->getData('name')))
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

    public function apiPositionGet(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::POSITION)
        ) {
            $response->set('position_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $position = PositionMapper::get((int) $request->getData('id'));
        $response->set($request->__toString(), $position->jsonSerialize());
    }

    public function apiPositionDelete(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::DELETE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::POSITION)
        ) {
            $response->set('position_delete', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $position = PositionMapper::get((int) $request->getData('id'));
        $status = PositionMapper::delete($position);

        $response->set($request->__toString(), $status);
    }

    public function apiPositionSet(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::POSITION)
        ) {
            $response->set('position_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $position = PositionMapper::get((int) $request->getData('id'));
        
        $position->setName((string) ($request->getData('name') ?? $position->getName()));
        $position->setDescription((string) ($request->getData('description') ?? $position->getDescription()));
        
        $parent = (int) $request->getData('parent'); 
        $position->setParent(!empty($parent) ? $parent : $position->getParent());
        
        $department = (int) $request->getData('department');
        $position->setDepartment(!empty($department) ? $department : $position->getDepartment());
        $position->setStatus((int) ($request->getData('status') ?? $position->getStatus()));
        
        PositionMapper::update($position);
        
        $response->set($request->__toString(), $position->jsonSerialize());
    }
    
    public function apiPositionCreate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::POSITION)
        ) {
            $response->set('position_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validatePositionCreate($request))) {
            $response->set('position_create', new FormValidation($val));

            return;
        }

        $position = new Position();
        $position->setName((string) ($request->getData('name')));
        $position->setStatus((int) $request->getData('status'));
        $position->setDescription((string) ($request->getData('description') ?? ''));
        
        $parent = (int) $request->getData('parent');
        $position->setParent(!empty($parent) ? $parent : null);
        
        $department = (int) $request->getData('department');
        $position->setDepartment(!empty($department) ? $department : null);

        PositionMapper::create($position);

        $response->set($request->__toString(), $position->jsonSerialize());
    }

    private function validateDepartmentCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (
            ($val['name'] = empty($request->getData('name')))
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

    public function apiDepartmentGet(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::DEPARTMENT)
        ) {
            $response->set('department_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $department = DepartmentMapper::get((int) $request->getData('id'));
        $response->set($request->__toString(), $department->jsonSerialize());
    }

    public function apiDepartmentSet(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::DEPARTMENT)
        ) {
            $response->set('department_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $department = DepartmentMapper::get((int) $request->getData('id'));
        
        $department->setName((string) ($request->getData('name') ?? $department->getName()));
        $department->setDescription((string) ($request->getData('description') ?? $department->getDescription()));
        
        $parent = (int) $request->getData('parent');
        $department->setParent(!empty($parent) ? $parent : $department->getParent());
        $department->setStatus((int) ($request->getData('status') ?? $department->getStatus()));
        
        $unit = (int) $request->getData('unit');
        $department->setUnit(!empty($unit) ? $unit : $department->getUnit());
        
        DepartmentMapper::update($department);
        
        $response->set($request->__toString(), $department->jsonSerialize());
    }

    public function apiDepartmentDelete(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::DELETE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::DEPARTMENT)
        ) {
            $response->set('department_delete', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $department = DepartmentMapper::get((int) $request->getData('id'));
        $status = DepartmentMapper::delete($department);

        $response->set($request->__toString(), $status);
    }

    public function apiDepartmentCreate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::DEPARTMENT)
        ) {
            $response->set('department_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validateDepartmentCreate($request))) {
            $response->set('department_create', new FormValidation($val));

            return;
        }

        $department = new Department();
        $department->setName((string) $request->getData('name'));
        $department->setStatus((int) $request->getData('status'));
        
        $parent = (int) $request->getData('parent');
        $department->setParent(!empty($parent) ? $parent : null);
        $department->setUnit((int) ($request->getData('unit') ?? 1));
        $department->setDescription((string) ($request->getData('description') ?? ''));

        DepartmentMapper::create($department);

        $response->set($request->__toString(), $department->jsonSerialize());
    }
}
