<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Admin\Controller;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\AccountMapper;
use Modules\Admin\Models\AccountPermissionMapper;
use Modules\Admin\Models\Group;
use Modules\Admin\Models\GroupMapper;
use Modules\Admin\Models\GroupPermissionMapper;
use Modules\Admin\Models\NullAccountPermission;
use Modules\Admin\Models\NullGroupPermission;

use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\RelationType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Module\InfoManager;
use phpOMS\Views\View;

/**
 * Admin controller class.
 *
 * This class is responsible for the basic admin activities such as managing accounts, groups, permissions and modules.
 *
 * @package Modules\Admin
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 * @codeCoverageIgnore
 */
final class BackendController extends Controller
{

    /**
     * Method which generates the general settings view.
     *
     * In this view general settings for the entire application can be seen and adjusted. Settings which can be modified
     * here are localization, password, database, etc.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewSettingsGeneral(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view     = new View($this->app, $request, $response);
        $settings = $this->app->appSettings->get([
                1000000001, 1000000002, 1000000003, 1000000004, 1000000005, 1000000006, 1000000007, 1000000008, 1000000009,
                1000000010, 1000000011, 1000000012, 1000000013, 1000000014, 1000000015, 1000000016, 1000000017, 1000000018, 1000000019,
                1000000020, 1000000021, 1000000022, 1000000023, 1000000024, 1000000025, 1000000026, 1000000027, 1000000028, 1000000029,
                1000001001, 1000001002, 1000001003, 1000001004, 1000001005,
                1000002001, 1000002002, 1000002003, 1000002004, 1000002005, 1000002006,
                1000003001, 1000003002, 1000003003, 1000003004, 1000003005, 1000003006,
                1000004001, 1000004002, 1000004003, 1000004004, 1000004005,
                1000005001, 1000005002, 1000005003, 1000005004, 1000005005, 1000005006, 1000005007, 1000005008,
            ]);

        $view->setTemplate('/Modules/Admin/Theme/Backend/settings-general');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));
        $view->setData('settings', $settings);

        return $view;
    }

    /**
     * Method which generates the general settings view.
     *
     * In this view general settings for the entire application can be seen and adjusted. Settings which can be modified
     * here are localization, password, database, etc.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewEmptyCommand(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Console/empty-command');

        return $view;
    }

    /**
     * Method which generates the account list view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewAccountList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));
        $view->setData('list:elements', AccountMapper::getNewest(50, null, RelationType::NONE));
        $view->setData('list:count', 1);

        return $view;
    }

    /**
     * Method which generates the account view of a single account.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewAccountSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));
        $view->addData('account', AccountMapper::get((int) $request->getData('id'), RelationType::ALL, null, 2));

        $permissions = AccountPermissionMapper::getFor((int) $request->getData('id'), 'account');

        if (!isset($permissions) || $permissions instanceof NullAccountPermission) {
            $permissions = [];
        } elseif (!\is_array($permissions)) {
            $permissions = [$permissions];
        }

        $view->addData('permissions', $permissions);

        $accGrpSelector = new \Modules\Admin\Theme\Backend\Components\GroupTagSelector\GroupTagSelectorView($this->app, $request, $response);
        $view->addData('grpSelector', $accGrpSelector);

        return $view;
    }

    /**
     * Method which generates the create account view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewAccountCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));

        return $view;
    }

    /**
     * Method which generates the group list view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewGroupList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000103001, $request, $response));
        $view->setData('list:elements', GroupMapper::getAll(RelationType::NONE));

        return $view;
    }

    /**
     * Method which generates the group view of a single group.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewGroupSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000103001, $request, $response));
        $view->addData('group', GroupMapper::get((int) $request->getData('id'), RelationType::ALL, null, 2));

        $permissions = GroupPermissionMapper::getFor((int) $request->getData('id'), 'group');

        if (!isset($permissions) || $permissions instanceof NullGroupPermission) {
            $permissions = [];
        } elseif (!\is_array($permissions)) {
            $permissions = [$permissions];
        }

        $view->addData('permissions', $permissions);

        $accGrpSelector = new \Modules\Profile\Theme\Backend\Components\AccountGroupSelector\BaseView($this->app, $request, $response);
        $view->addData('accGrpSelector', $accGrpSelector);

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }

    /**
     * Method which generates the group create view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewGroupCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000103001, $request, $response));

        $editor = new \Modules\Editor\Theme\Backend\Components\Editor\BaseView($this->app, $request, $response);
        $view->addData('editor', $editor);

        return $view;
    }

    /**
     * Method which generates the module list view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewModuleList(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/modules-list');

        return $view;
    }

    /**
     * Method which generates the module profile view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewModuleProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : RenderableInterface
    {
        $view = new View($this->app, $request, $response);
        $view->setTemplate('/Modules/Admin/Theme/Backend/modules-single');

        $id = $request->getData('id') ?? '';
        $view->setData('modules', $this->app->moduleManager->getAllModules());
        $view->setData('active', $this->app->moduleManager->getActiveModules());
        $view->setData('installed', $installed = $this->app->moduleManager->getInstalledModules());
        $view->setData('id', $id);

        $path = \realpath(__DIR__ . '/../' . $id . '/info.json');

        if (isset($installed[$id]) && $path !== false) {
            $info = new InfoManager($path);
            $info->load();

            $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(
                $info->getId(),
                $request, $response
            ));
        }

        $groupPermission = GroupMapper::getPermissionForModule($id);
        $view->setData('groupPermissions', $groupPermission);

        return $view;
    }
}
