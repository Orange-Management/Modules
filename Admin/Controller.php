<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Admin;

use Model\Message\FormValidation;
use Modules\Admin\Models\Account;
use Modules\Admin\Models\AccountMapper;
use Modules\Admin\Models\Group;
use Modules\Admin\Models\GroupMapper;
use phpOMS\Account\GroupStatus;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\System\MimeType;
use phpOMS\Views\View;

/**
 * Admin controller class.
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
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
    const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    const MODULE_NAME = 'Admin';

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
    protected static $dependencies = [];

    /**
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewSettingsGeneral(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $settings = $this->app->appSettings->get([
            1000000009,
            1000000019,
            1000000020,
            1000000021,
            1000000022,
            1000000023,
            1000000027,
            1000000028,
        ]);

        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/settings-general');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));

        $view->setData('oname', $settings[1000000009]);
        $view->setData('country', $settings[1000000019]);
        $view->setData('timezone', $settings[1000000021]);
        $view->setData('timeformat', $settings[1000000022]);
        $view->setData('language', $settings[1000000020]);
        $view->setData('currency', $settings[1000000023]);
        $view->setData('decimal_point', $settings[1000000027]);
        $view->setData('thousands_sep', $settings[1000000028]);
        $view->setData('countries', $settings[1000000028]);

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewAccountList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));

        $view->setData('list:elements', AccountMapper::getAll());
        $view->setData('list:count', 1);

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewAccountSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));

        $view->addData('account', AccountMapper::get((int) $request->getData('id')));

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewAccountCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewGroupList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000103001, $request, $response));

        $view->setData('list:elements', GroupMapper::getAll());

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewGroupSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000103001, $request, $response));

        $view->addData('group', GroupMapper::get((int) $request->getData('id')));

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewGroupCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000103001, $request, $response));

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewModuleList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/modules-list');

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
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function viewModuleProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/modules-single');

        return $view;
    }

    public function apiSettingsGet(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $response->set('settings', $this->app->appSettings->get($request->getData('id')));
    }

    public function apiSettingsSet(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $success = $this->app->appSettings->set((array) $request->getData('settings'), true);

        $response->set('settings', $success);
    }

    public function apiGroupGet(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $response->set('group', GroupMapper::getByRequest($request));
    }

    public function apiGroupCreate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $val = [];
        if (
        ($val['name'] = empty($request->getData('name')))
            || ($val['parent'] = (
                    $request->getData('parent') !== null
                    && !is_numeric($request->getData('parent'))
                ))
                || ($val['status'] = (
                    $request->getData('status') === null
                    || !GroupStatus::isValidValue((int) $request->getData('status'))
                ))
        ) {
            $response->set('group_create_validation', new FormValidation($val));

            return;
        }
        $group = new Group();
        $group->setName($request->getData('name'));
        $group->setName((int) $request->getData('status'));
        $group->setDescription($request->getData('desc'));

        GroupMapper::create($group);

        $response->set('group', $group->__toString());
    }

    public function apiGroupDelete(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $status = GroupMapper::delete($request->getData('id'));

        $response->set('group', $status);
    }

    public function apiGroupUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $group = GroupMapper::get($request->getData('id'));
        $group->setName($request->getData('name'));
        $group->setDescription($request->getData('desc'));

        $status = GroupMapper::update($group);

        $response->set('group', ['status' => $status, 'group' => $group->__toString()]);
    }

    public function apiAccountGet(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $response->getHeader()->set('Content-Type', MimeType::M_JSON . '; charset=utf-8', true);
        $response->set('account', AccountMapper::getByRequest($request));
    }

    public function apiAccountCreate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $account = new Account();
        $account->setName($request->getData('name'));
        $account->setDescription($request->getData('desc'));

        AccountMapper::create($account);

        $response->set('account', $account->jsonSerialize());
    }

    public function apiAccountDelete(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $status = AccountMapper::delete($request->getData('id'));

        $response->set('account', $status);
    }

    public function apiAccountUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $account = AccountMapper::get($request->getData('id'));
        $account->setName($request->getData('name'));
        $account->setDescription($request->getData('desc'));

        $status = AccountMapper::update($account);

        $response->set('account', ['status' => $status, 'account' => $account->jsonSerialize()]);
    }

    public function apiModuleStatusUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null)
    {
        $module = $request->getData('module');
        $status = $request->getData('status');

        if (!$module || !$status) {
            // todo: create failure response
        }

        switch ($status) {
            case 'activate':
                $done = $this->app->moduleManager->activate($module);
                break;
            case 'deactivate':
                $done = $this->app->moduleManager->deactivate($module);
                break;
            case 'install':
                $done = $this->app->moduleManager->install($module);
                break;
            case 'uninstall':
                //$done = $this->app->moduleManager->uninstall($module);
                $done = true;
                break;
            default:
                $done = false;
        }

        $response->set('module', [$status => $done, 'module' => $module]);
    }
}
