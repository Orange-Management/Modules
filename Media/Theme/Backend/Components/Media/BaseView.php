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
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Media\Theme\Backend\Components\Media;

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
class BaseView extends View
{
    protected $media = [];

    /**
     * {@inheritdoc}
     */
    public function __construct(ApplicationAbstract $app, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($app, $request, $response);
        $this->setTemplate('/Modules/Media/Theme/Backend/Components/Media/list');
    }

    /**
     * {@inheritdoc}
     */
    public function render(...$data) : string
    {
        $this->media = $data[0];
        return parent::render();
    }
}
