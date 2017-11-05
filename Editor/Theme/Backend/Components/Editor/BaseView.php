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

namespace Modules\Editor\Theme\Backend\Components\Editor;

use phpOMS\Views\View;
use phpOMS\ApplicationAbstract;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

class BaseView extends View
{
    private $id = '';

    public function __construct(ApplicationAbstract $app, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
        $this->setTemplate('/Modules/Editor/Theme/Backend/Components/Editor/inline-editor-tools');

        $view = new TextView($app, $request, $response);
        $this->addData('text', $view);
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