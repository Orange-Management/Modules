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

namespace Modules\Calendar\Theme\Backend\Components\Calendar;

use phpOMS\ApplicationAbstract;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

class BaseView extends View
{
    protected $calendar = [];

    public function __construct(ApplicationAbstract $app, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
        $this->setTemplate('/Modules/Calendar/Theme/Backend/Components/Calendar/mini');
    }

    public function render(...$data) : string
    {
        if (empty($data) || $data[0] === null) {
            return '';
        }

        $this->calendar = $data[0];
        return parent::render();
    }
}
