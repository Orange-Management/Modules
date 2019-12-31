<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Organization
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Organization\Controller;

use Modules\Organization\Models\Department;
use Modules\Organization\Models\DepartmentMapper;
use Modules\Organization\Models\Position;
use Modules\Organization\Models\PositionMapper;
use Modules\Organization\Models\Status;
use Modules\Organization\Models\Unit;
use Modules\Organization\Models\UnitMapper;

use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;
use phpOMS\System\MimeType;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * Organization Controller class.
 *
 * @package Modules\Organization
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#135
 *  Automatic group generation *optional*
 *  Whenever a new
 *      * Unit
 *      * Department
 *      * Position
 *  is created a new group is created and all of the possibilities (this should be a optional setting for the module).
 *  Group name strucutre: org:position-department-unit or org:unit-department-position
 *  This should be solvable through hooks.
 */
final class ApiController extends Controller
{
    /**
     * Validate unit create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateUnitCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = empty($request->getData('name')))
            || ($val['parent'] = (
                !empty($request->getData('parent'))
                && !\is_numeric($request->getData('parent'))
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
     * @since 1.0.0
     */
    public function apiUnitGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $unit = UnitMapper::get((int) $request->getData('id'));
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Unit', 'Unit successfully returned.', $unit);
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
     * @since 1.0.0
     */
    public function apiUnitSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $old = clone UnitMapper::get((int) $request->getData('id'));
        $new = $this->updateUnitFromRequest($request);
        $this->updateModel($request, $old, $new, UnitMapper::class, 'unit');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Unit', 'Unit successfully updated.', $new);
    }

    /**
     * Method to update unit from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Unit
     *
     * @since 1.0.0
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
     * @since 1.0.0
     */
    public function apiUnitDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $unit = UnitMapper::get((int) $request->getData('id'));
        $this->deleteModel($request, $unit, UnitMapper::class, 'unit');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Unit', 'Unit successfully deleted.', $unit);
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
     * @since 1.0.0
     */
    public function apiUnitCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateUnitCreate($request))) {
            $response->set('unit_create', new FormValidation($val));

            return;
        }

        $unit = $this->createUnitFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $unit, UnitMapper::class, 'unit');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Unit', 'Unit successfully created.', $unit);
    }

    /**
     * Method to create unit from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Unit
     *
     * @since 1.0.0
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
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validatePositionCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = empty($request->getData('name')))
            || ($val['parent'] = (
                !empty($request->getData('parent'))
                && !\is_numeric($request->getData('parent'))
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
     * @since 1.0.0
     */
    public function apiPositionGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $position = PositionMapper::get((int) $request->getData('id'));
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Position', 'Position successfully returned.', $position);
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
     * @since 1.0.0
     */
    public function apiPositionDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $position = PositionMapper::get((int) $request->getData('id'));
        $this->deleteModel($request, $position, PositionMapper::class, 'position');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Position', 'Position successfully deleted.', $position);
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
     * @since 1.0.0
     */
    public function apiPositionSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $old = clone PositionMapper::get((int) $request->getData('id'));
        $new = $this->updatePositionFromRequest($request);
        $this->updateModel($request, $old, $new, PositionMapper::class, 'position');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Position', 'Position successfully updated.', $new);
    }

    /**
     * Method to update position from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Position
     *
     * @since 1.0.0
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
     * @since 1.0.0
     */
    public function apiPositionCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validatePositionCreate($request))) {
            $response->set('position_create', new FormValidation($val));

            return;
        }

        $position = $this->createPositionFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $position, PositionMapper::class, 'position');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Position', 'Position successfully created.', $position);
    }

    /**
     * Method to create position from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Position
     *
     * @since 1.0.0
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
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateDepartmentCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = empty($request->getData('name')))
            || ($val['parent'] = (
                !empty($request->getData('parent'))
                && !\is_numeric($request->getData('parent'))
            ))
            || ($val['unit'] = (
                !\is_numeric($request->getData('unit'))
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
     * @since 1.0.0
     */
    public function apiDepartmentGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $department = DepartmentMapper::get((int) $request->getData('id'));
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Department', 'Department successfully returned.', $department);
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
     * @since 1.0.0
     */
    public function apiDepartmentSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $old = clone DepartmentMapper::get((int) $request->getData('id'));
        $new = $this->updateDepartmentFromRequest($request);
        $this->updateModel($request, $old, $new, DepartmentMapper::class, 'department');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Department', 'Department successfully updated.', $new);
    }

    /**
     * Method to update department from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Department
     *
     * @since 1.0.0
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
     * @since 1.0.0
     */
    public function apiDepartmentDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $department = DepartmentMapper::get((int) $request->getData('id'));
        $this->deleteModel($request, $department, DepartmentMapper::class, 'department');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Department', 'Department successfully deleted.', $department);
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
     * @since 1.0.0
     */
    public function apiDepartmentCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateDepartmentCreate($request))) {
            $response->set('department_create', new FormValidation($val));

            return;
        }

        $department = $this->createDepartmentFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $department, DepartmentMapper::class, 'department');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Department', 'Department successfully created.', $department);
    }

    /**
     * Method to create a department from a request
     *
     * @param RequestAbstract $request Request
     *
     * @return Department
     *
     * @since 1.0.0
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

    /**
     * Api method to find units
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
    public function apiUnitFind(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set(
            $request->getUri()->__toString(),
            \array_values(
                UnitMapper::find((string) ($request->getData('search') ?? ''))
            )
        );
    }

    /**
     * Api method to find departments
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
    public function apiDepartmentFind(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set(
            $request->getUri()->__toString(),
            \array_values(
                DepartmentMapper::find((string) ($request->getData('search') ?? ''))
            )
        );
    }

    /**
     * Api method to find positions
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
    public function apiPositionFind(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set(
            $request->getUri()->__toString(),
            \array_values(
                PositionMapper::find((string) ($request->getData('search') ?? ''))
            )
        );
    }
}
