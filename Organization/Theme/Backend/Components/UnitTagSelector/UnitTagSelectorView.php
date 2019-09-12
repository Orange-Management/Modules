<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   TBD
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Organization\Theme\Backend\Components\UnitTagSelector;

use phpOMS\ApplicationAbstract;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Component view.
 *
 * @package TBD
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 * @codeCoverageIgnore
 */
class UnitTagSelectorView extends View
{
    private $id         = '';
    private $isRequired = false;

    /**
     * {@inheritdoc}
     */
    public function __construct(ApplicationAbstract $app, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
        $this->setTemplate('/Modules/Organization/Theme/Backend/Components/UnitTagSelector/unit-selector');

        $view = new UnitTagSelectorPopupView($app, $request, $response);
        $this->addData('unit-selector-popup', $view);
    }

    public function getId() : string
    {
        return $this->id;
    }

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
        $this->getData('unit-selector-popup')->setId($this->id);

        return parent::render();
    }
}
