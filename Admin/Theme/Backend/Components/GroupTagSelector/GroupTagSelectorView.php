<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Admin\Theme\Backend\Components\GroupTagSelector;

use phpOMS\Views\View;
use phpOMS\ApplicationAbstract;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

class GroupTagSelectorView extends View
{
    private $id         = '';
    private $isRequired = false;

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

    public function render(...$data) : string
    {
        $this->id         = $data[0];
        $this->isRequired = $data[1] ?? false;
        $this->getData('group-selector-popup')->setId($this->id);
        
        return parent::render();
    }
}
