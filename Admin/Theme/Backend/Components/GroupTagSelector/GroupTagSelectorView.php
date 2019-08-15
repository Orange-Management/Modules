<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\Theme\Backend\Components\GroupTagSelector;

use phpOMS\ApplicationAbstract;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Component view.
 *
 * @package    TBD
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 * @codeCoverageIgnore
 */
class GroupTagSelectorView extends View
{
    private $id         = '';
    private $isRequired = false;

    /**
     * {@inheritdoc}
     */
    public function __construct(ApplicationAbstract $app, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
        $this->setTemplate('/Modules/Admin/Theme/Backend/Components/GroupTagSelector/group-selector');

        $view = new GroupTagSelectorPopupView($app, $request, $response);
        $this->addData('group-selector-popup', $view);
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
        $this->getData('group-selector-popup')->setId($this->id);

        return parent::render();
    }
}
