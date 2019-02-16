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

use phpOMS\ApplicationAbstract;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Component view.
 *
 * @package    TBD
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 * @codeCoverageIgnore
 */
class TextView extends View
{
    private $id      = '';
    private $name    = '';
    private $form    = '';
    private $plain   = '';
    private $preview = '';

    /**
     * {@inheritdoc}
     */
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

    public function getPreview() : string
    {
        return $this->preview;
    }

    public function getPlain() : string
    {
        return $this->plain;
    }

    /**
     * {@inheritdoc}
     */
    public function render(...$data) : string
    {
        $this->id      = $data[0] ?? '';
        $this->name    = $data[1] ?? '';
        $this->form    = $data[2] ?? '';
        $this->plain   = $data[3] ?? '';
        $this->preview = $data[4] ?? '';

        return parent::render();
    }
}
