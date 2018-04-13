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

namespace Modules\Editor\Theme\Backend\Components\Editor;

use phpOMS\Views\View;
use phpOMS\ApplicationAbstract;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

class TextView extends View
{
    private $id   = '';
    private $name = '';
    private $form = '';

    public function __construct(ApplicationAbstract $app, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
        $this->setTemplate('/Modules/Editor/Theme/Backend/Components/Editor/inline-editor');
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getForm() : string
    {
        return $this->form;
    }

    public function render(...$data) : string
    {
        $this->id   = $data[0] ?? '';
        $this->name = $data[1] ?? '';
        $this->form = $data[2] ?? '';

        return parent::render();
    }
}
