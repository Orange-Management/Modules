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
use phpOMS\Asset\AssetType;
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
class BaseView extends View
{
    private $id = '';

    /**
     * {@inheritdoc}
     */
    public function __construct(ApplicationAbstract $app, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
        $this->setTemplate('/Modules/Editor/Theme/Backend/Components/Editor/inline-editor-tools');

        $response->get('Content')->getData('head')->addAsset(AssetType::JSLATE, 'Modules/Editor/Controller.js', ['type' => 'module']);

        $view = new TextView($app, $request, $response);
        $this->addData('text', $view);
    }

    public function renderId() : string
    {
        return $this->printHtml($this->id);
    }

    /**
     * {@inheritdoc}
     */
    public function render(...$data) : string
    {
        $this->id = ($data[0] ?? '') . '-tools';
        return parent::render();
    }
}
