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

namespace Modules\Organization\Theme\Backend\Components\DepartmentTagSelector;

use phpOMS\ApplicationAbstract;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Component view.
 *
 * @package Modules\Organization
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 * @codeCoverageIgnore
 */
class DepartmentTagSelectorView extends View
{
    private $id         = '';
    private $isRequired = false;

    /**
     * {@inheritdoc}
     */
    public function __construct(ApplicationAbstract $app, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
        $this->setTemplate('/Modules/Organization/Theme/Backend/Components/DepartmentTagSelector/department-selector');

        $view = new DepartmentTagSelectorPopupView($app, $request, $response);
        $this->addData('department-selector-popup', $view);
    }

    /**
     * Get the selector id
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * Is required?
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function isRequired() : bool
    {
        return $this->isRequired;
    }

    /**
     * {@inheritdoc}
     */
    public function render(...$data) : string
    {
        $this->id         = $data[0];
        $this->isRequired = $data[1] ?? false;
        $this->getData('department-selector-popup')->setId($this->id);

        return parent::render();
    }
}
