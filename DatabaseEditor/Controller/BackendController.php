<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\DatabaseEditor
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\DatabaseEditor\Controller;

use phpOMS\Asset\AssetType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Html\Head;
use phpOMS\Views\View;

/**
 * Database controller class.
 *
 * @package    Modules\DatabaseEditor
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class BackendController extends Controller
{
    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewDatabaseEditorEditor(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/DatabaseEditor/Theme/Backend/database-editor');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1007401001, $request, $response));

        return $view;
    }
}
