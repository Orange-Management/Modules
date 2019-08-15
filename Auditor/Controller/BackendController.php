<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    Modules\Auditor
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Auditor\Controller;

use Modules\Admin\Models\AccountMapper;
use Modules\Auditor\Models\AuditMapper;

use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\RelationType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Calendar controller class.
 *
 * @package    Modules\Auditor
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
     * @return RenderableInterface
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewAuditorList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Auditor/Theme/Backend/audit-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006201001, $request, $response));

        $list = AuditMapper::getNewest(50);
        $view->setData('audits', $list);

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
    public function viewAuditorSingle(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Auditor/Theme/Backend/audit-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006201001, $request, $response));

        $audit = AuditMapper::get((int) $request->getData('id'));
        $view->setData('audit', $audit);

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
    public function viewAuditorModuleList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Auditor/Theme/Backend/module-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006201001, $request, $response));

        $list = $this->app->moduleManager->getAllModules();
        $view->setData('modules', $list);

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
    public function viewAuditorModuleSingle(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Auditor/Theme/Backend/module-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006201001, $request, $response));

        $list = AuditMapper::get(50);
        $view->setData('audits', $list);

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
    public function viewAuditorAccountList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Auditor/Theme/Backend/account-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006201001, $request, $response));

        $view->setData('accounts', AccountMapper::getNewest(50, null, RelationType::NONE));

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
    public function viewAuditorAccountSingle(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Auditor/Theme/Backend/account-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1006201001, $request, $response));

        $list = AuditMapper::get(50);
        $view->setData('audits', $list);

        return $view;
    }
}
