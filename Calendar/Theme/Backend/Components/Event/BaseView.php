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

namespace Modules\Calendar\Theme\Backend\Components\Event;

use phpOMS\ApplicationAbstract;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

class BaseView extends View
{
    private $id = '';

    public function __construct(ApplicationAbstract $app, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
        $this->setTemplate('/Modules/Calendar/Theme/Backend/Components/Event/popup');
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function render(...$data) : string
    {
        $this->id = $data[0];
        return parent::render();
    }
}
