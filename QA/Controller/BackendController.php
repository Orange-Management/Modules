<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\QA
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\QA\Controller;

use Modules\QA\Models\QAQuestionMapper;

use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

use phpOMS\Views\View;

/**
 * Task class.
 *
 * @package    Modules\QA
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class BackendController extends Controller
{
    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function setUpBackend(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/QA/Theme/Backend/styles.css');
    }

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewQADashboard(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
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
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewQADoc(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/QA/Theme/Backend/qa-question');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006001001, $request, $response));

        $question = QAQuestionMapper::get((int) $request->getData('id'));
        $view->addData('question', $question);

        return $view;
    }
    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewQAQuestionCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/QA/Theme/Backend/qa-question-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006001001, $request, $response));

        $question = QAQuestionMapper::get((int) $request->getData('id'));
        $view->addData('question', $question);

        return $view;
    }
}
