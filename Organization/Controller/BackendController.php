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
use Modules\Organization\Models\UnitMapper;

use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Organization Controller class.
 *
 * @package Modules\Organization
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class BackendController extends Controller
{

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewUnitList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Organization/Theme/Backend/unit-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004703001, $request, $response));

        $view->addData('list:elements', UnitMapper::getAll());

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewUnitProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Organization/Theme/Backend/unit-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004703001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\UnitTagSelector\UnitTagSelectorView($this->app, $request, $response);
        $view->addData('unit-selector', $selectorView);
        $view->addData('unit', UnitMapper::get((int) $request->getData('id')));

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewOrganigram(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Organization/Theme/Backend/organigram');

        $units    = UnitMapper::getAll();
        $unitTree = $this->createOrgTree($units);
        $view->setData('unitTree', $unitTree);

        $departments = DepartmentMapper::getAll();
        $depTree     = $this->createOrgTree($departments);
        $view->setData('departmentTree', $depTree);

        $positions = PositionMapper::getAll();
        $posTree   = $this->createOrgTree($positions);
        $view->setData('positionTree', $posTree);

        return $view;
    }

    private function createOrgTree($components) : array
    {
        $tree = [];
        foreach ($components as $component) {
            $ref = null;
            if ($component instanceof Department) {
                $ref = $component->getUnit()->getId();
            } elseif ($component instanceof Position) {
                $ref = $component->getDepartment()->getId();
            }

            if (!isset($tree[$ref][$component->getId()])) {
                $tree[$ref][$component->getId()] = ['obj' => null, 'children' => [], 'index' => 0];
            }

            $tree[$ref][$component->getId()]['obj'] = $component;

            $parent = $component->getParent()->getId();
            if (!($component instanceof Position) // parent could be in different department then ignore
                || $component->getParent()->getDepartment()->getId() === $component->getDepartment()->getId()
            ) {
                if (!isset($tree[$ref][$parent])) {
                    $tree[$ref][$parent] = ['obj' => null, 'children' => [], 'index' => 0];
                }

                $tree[$ref][$parent]['children'][] = &$tree[$ref][$component->getId()];
            }
        }

        return $tree;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewUnitCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Organization/Theme/Backend/unit-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004703001, $request, $response));

        $uploadView = new \Modules\Media\Theme\Backend\Components\InlinePreview\BaseView($this->app, $request, $response);
        $view->addData('media-preview-upload', $uploadView);

        $selectorView = new \Modules\Organization\Theme\Backend\Components\UnitTagSelector\UnitTagSelectorView($this->app, $request, $response);
        $view->addData('unit-selector', $selectorView);

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewDepartmentList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Organization/Theme/Backend/department-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004704001, $request, $response));

        $view->addData('list:elements', DepartmentMapper::getAll());

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewDepartmentProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Organization/Theme/Backend/department-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004704001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\DepartmentTagSelector\DepartmentTagSelectorView($this->app, $request, $response);
        $view->addData('department-selector', $selectorView);

        $unitSelectorView = new \Modules\Organization\Theme\Backend\Components\UnitTagSelector\UnitTagSelectorView($this->app, $request, $response);
        $view->addData('unit-selector', $unitSelectorView);

        $view->addData('department', DepartmentMapper::get((int) $request->getData('id')));

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewDepartmentCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Organization/Theme/Backend/department-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004704001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\DepartmentTagSelector\DepartmentTagSelectorView($this->app, $request, $response);
        $view->addData('department-selector', $selectorView);

        $unitSelectorView = new \Modules\Organization\Theme\Backend\Components\UnitTagSelector\UnitTagSelectorView($this->app, $request, $response);
        $view->addData('unit-selector', $unitSelectorView);

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewPositionList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Organization/Theme/Backend/position-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004705001, $request, $response));

        $view->addData('list:elements', PositionMapper::getAll());

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewPositionProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Organization/Theme/Backend/position-profile');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004705001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\PositionTagSelector\PositionTagSelectorView($this->app, $request, $response);
        $view->addData('position-selector', $selectorView);

        $departmentSelectorView = new \Modules\Organization\Theme\Backend\Components\DepartmentTagSelector\DepartmentTagSelectorView($this->app, $request, $response);
        $view->addData('department-selector', $departmentSelectorView);

        $view->addData('position', PositionMapper::get((int) $request->getData('id')));

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewPositionCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Organization/Theme/Backend/position-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1004705001, $request, $response));

        $selectorView = new \Modules\Organization\Theme\Backend\Components\PositionTagSelector\PositionTagSelectorView($this->app, $request, $response);
        $view->addData('position-selector', $selectorView);

        $departmentSelectorView = new \Modules\Organization\Theme\Backend\Components\DepartmentTagSelector\DepartmentTagSelectorView($this->app, $request, $response);
        $view->addData('department-selector', $departmentSelectorView);

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }
}
