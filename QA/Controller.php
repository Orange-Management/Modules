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
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\QA;

use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\Views\View;
use phpOMS\Asset\AssetType;

use Modules\QA\Models\QAQuestionMapper;
use Modules\QA\Models\QABadgeMapper;

/**
 * Task class.
 *
 * @category   Modules
 * @package    Modules\QA
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Controller extends ModuleAbstract implements WebInterface
{

    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    /* public */ const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    /* public */ const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    /* public */ const MODULE_NAME = 'QA';

    /**
     * Providing.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];

    public function setUpBackend(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, $request->getUri()->getBase() . 'Modules/QA/Theme/Backend/styles.css');
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     */
    public function viewQADashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/QA/Theme/Backend/qa-dashboard');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006001001, $request, $response));

        $list = QAQuestionMapper::getNewest(50);
        $view->setData('questions', $list);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     */
    public function viewQABadgeList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/QA/Theme/Backend/qa-tag-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006001001, $request, $response));

        $list = QABadgeMapper::getAll();
        $view->setData('tags', $list);

        return $view;
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     */
    public function viewQABadgeEdit(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/QA/Theme/Backend/qa-tag-edit');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006001001, $request, $response));

        $tag = QABadgeMapper::get((int) $request->getData('id'));
        $view->setData('tag', $tag);

        return $view;
    }

    public function viewQADoc(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/QA/Theme/Backend/qa-question');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006001001, $request, $response));

        $question = QAQuestionMapper::get((int) $request->getData('id'));
        $view->addData('question', $question);

        return $view;
    }
}
