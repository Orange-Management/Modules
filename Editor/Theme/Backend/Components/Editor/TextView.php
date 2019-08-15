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

namespace Modules\Editor\Theme\Backend\Components\Editor;

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
class TextView extends View
{
    private $id       = '';
    private $name     = '';
    private $form     = '';
    private $plain    = '';
    private $preview  = '';
    private $tplText  = '';
    private $tplValue = '';

    /**
     * {@inheritdoc}
     */
    public function __construct(ApplicationAbstract $app, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
        $this->setTemplate('/Modules/Editor/Theme/Backend/Components/Editor/inline-editor');
    }

    public function renderId() : string
    {
        return $this->printHtml($this->id);
    }

    public function renderName() : string
    {
        return $this->printHtml($this->name);
    }

    public function renderForm() : string
    {
        return $this->printHtml($this->form);
    }

    public function renderPreview() : string
    {
        return $this->preview;
    }

    public function renderPlain() : string
    {
        return $this->printHtml($this->plain);
    }

    public function renderTplText() : string
    {
        return $this->printHtml($this->tplText);
    }

    public function renderTplValue() : string
    {
        return $this->printHtml($this->tplValue);
    }

    /**
     * {@inheritdoc}
     */
    public function render(...$data) : string
    {
        $this->id       = $data[0] ?? '';
        $this->name     = $data[1] ?? '';
        $this->form     = $data[2] ?? '';
        $this->plain    = $data[3] ?? '';
        $this->preview  = $data[4] ?? '';
        $this->tplText  = $data[5] ?? '';
        $this->tplValue = $data[6] ?? '';

        return parent::render();
    }
}
