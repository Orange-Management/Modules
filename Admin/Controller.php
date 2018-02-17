<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    Modules\Admin
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Admin;

use Model\Message\FormValidation;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\AccountMapper;
use Modules\Admin\Models\AccountPermissionMapper;
use Modules\Admin\Models\NullAccountPermission;
use Modules\Admin\Models\Group;
use Modules\Admin\Models\GroupMapper;
use Modules\Admin\Models\GroupPermissionMapper;
use Modules\Admin\Models\NullGroupPermission;
use Modules\Admin\Models\PermissionState;

use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;
use phpOMS\Account\GroupStatus;
use phpOMS\Account\PermissionType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\System\MimeType;
use phpOMS\Utils\Parser\Markdown\Markdown;
use phpOMS\Views\View;

/**
 * Admin controller class.
 *
 * This class is responsible for the basic admin activities such as managing accounts, groups, permissions and modules.
 *
 * @package    Modules\Admin
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
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
    /* public */ const MODULE_NAME = 'Admin';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    /* public */ const MODULE_ID = 1000100000;

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
     * Method which generates the general settings view.
     *
     * In this view general settings for the entire application can be seen and adjusted. Settings which can be modified
     * here are localization, password, database, etc.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewSettingsGeneral(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::SETTINGS)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $settings = $this->app->appSettings->get([1000000009, 1000000019, 1000000020, 1000000021, 1000000022, 1000000023, 1000000027, 1000000028,]);

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
     * Method which generates the account list view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewAccountList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::ACCOUNT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));
        $view->setData('list:elements', AccountMapper::getNewest(50));
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
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewAccountSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::ACCOUNT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));
        $view->addData('account', AccountMapper::get((int) $request->getData('id')));

        $permissions = AccountPermissionMapper::getFor((int) $request->getData('id'), 'account');

        if (!isset($permissions) || $permissions instanceof NullAccountPermission) {
            $permissions = [];
        } elseif (!is_array($permissions)) {
            $permissions = [$permissions];
        }

        $view->addData('permissions', $permissions);

        return $view;
    }

    /**
     * Method which generates the create account view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewAccountCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::ACCOUNT)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

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
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewGroupList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::GROUP)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000103001, $request, $response));
        $view->setData('list:elements', GroupMapper::getAll());

        return $view;
    }

    /**
     * Method which generates the group view of a single group.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewGroupSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::GROUP)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000103001, $request, $response));
        $view->addData('group', GroupMapper::get((int) $request->getData('id')));

        $permissions = GroupPermissionMapper::getFor((int) $request->getData('id'), 'group');

        if (!isset($permissions) || $permissions instanceof NullGroupPermission) {
            $permissions = [];
        } elseif (!is_array($permissions)) {
            $permissions = [$permissions];
        }

        $view->addData('permissions', $permissions);

        return $view;
    }

    /**
     * Method which generates the group create view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewGroupCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::GROUP)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000103001, $request, $response));

        return $view;
    }

    /**
     * Method which generates the module list view.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewModuleList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::MODULE)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

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
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewModuleProfile(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::MODULE)
        ) {
            $view->setTemplate('/Web/Backend/Error/403_inline');
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return $view;
        }

        $view->setTemplate('/Modules/Admin/Theme/Backend/modules-single');

        return $view;
    }

    /**
     * Api method for getting settings
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiSettingsGet(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::SETTINGS)
        ) {
            $response->set('settings_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $response->set($request->__toString(), ['response' => $this->app->appSettings->get((int) $request->getData('id'))]);
    }

    /**
     * Api method for modifying settings
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiSettingsSet(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::SETTINGS)
        ) {
            $response->set('settings_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $success = $this->app->appSettings->set(
            json_decode((string) $request->getData('settings'), true),
            true
        );

        $response->set($request->__toString(), $success);
    }

    /**
     * Api method for getting a group
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiGroupGet(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::GROUP)
        ) {
            $response->set('group_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $group = GroupMapper::get((int) $request->getData('id'));
        $response->set($request->__toString(), [
            'status' => 'ok',
            'title' => 'Group',
            'message' => 'Group successfully returned.',
            'response' => $group->jsonSerialize()
        ]);
    }

    /**
     * Api method for modifying a group
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiGroupUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::GROUP)
        ) {
            $response->set('group_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $group = $this->updateGroupFromRequest($request);

        GroupMapper::update($group);
        $response->set($request->__toString(), [
            'status' => 'ok',
            'title' => 'Group',
            'message' => 'Group successfully updated.',
            'response' => $group->jsonSerialize()
        ]);
    }

    /**
     * Method to update group from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Group
     *
     * @since  1.0.0
     */
    private function updateGroupFromRequest(RequestAbstract $request) : Group
    {
        $group = GroupMapper::get((int) $request->getData('id'));
        $group->setName((string) ($request->getData('name') ?? $group->getName()));
        $group->setStatus((int) ($request->getData('status') ?? $group->getStatus()));
        $group->setDescription(Markdown::parse((string) ($request->getData('description') ?? $group->getDescriptionRaw())));
        $group->setDescriptionRaw((string) ($request->getData('description') ?? $group->getDescriptionRaw()));

        return $group;
    }

    /**
     * Validate group create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     */
    private function validateGroupCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = empty($request->getData('name')))
            || ($val['status'] = (
                $request->getData('status') === null
                || !GroupStatus::isValidValue((int) $request->getData('status'))
            ))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a group
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiGroupCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::GROUP)
        ) {
            $response->set('group_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validateGroupCreate($request))) {
            $response->set('group_create', new FormValidation($val));

            return;
        }

        $group = $this->createGroupFromRequest($request);

        GroupMapper::create($group);
        $response->set($request->__toString(), [
            'status' => 'ok',
            'title' => 'Group',
            'message' => 'Group successfully created.',
            'response' => $group->jsonSerialize()
        ]);
    }

    /**
     * Method to create group from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Group
     *
     * @since  1.0.0
     */
    private function createGroupFromRequest(RequestAbstract $request) : Group
    {
        $group = new Group();
        $group->setCreatedBy($request->getHeader()->getAccount());
        $group->setName((string) ($request->getData('name') ?? ''));
        $group->setStatus((int) ($request->getData('status') ?? GroupStatus::INACTIVE));
        $group->setDescription(Markdown::parse((string) ($request->getData('description') ?? '')));
        $group->setDescriptionRaw((string) ($request->getData('description') ?? ''));

        return $group;
    }

    /**
     * Api method to delete a group
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiGroupDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::DELETE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::GROUP)
        ) {
            $response->set('group_delete', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $group  = GroupMapper::get((int) $request->getData('id'));
        $status = GroupMapper::delete($group);

        $response->set($request->__toString(), [
            'status' => 'ok',
            'title' => 'Group',
            'message' => 'Group successfully deleted.',
            'response' => $status
        ]);
    }

    /**
     * Api method to get an accoung
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiAccountGet(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::ACCOUNT)
        ) {
            $response->set('account_read', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $account = AccountMapper::get((int) $request->getData('id'));
        $response->set($request->__toString(), [
            'status' => 'ok',
            'title' => 'Account',
            'message' => 'Account successfully returned.',
            'response' => $account->jsonSerialize()
        ]);
    }

    /**
     * Api method to find accounts
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiAccountFind(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::READ, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::ACCOUNT)
        ) {
            $response->set('account_find', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $response->getHeader()->set('Content-Type', MimeType::M_JSON . '; charset=utf-8', true);
        $response->set($request->__toString(), array_values(AccountMapper::find((string) ($request->getData('search') ?? ''))));
    }

    /**
     * Method to validate account creation from request
     *
     * @param RequestAbstract $request Request
     *
     * @return array
     *
     * @since  1.0.0
     */
    private function validateAccountCreate(RequestAbstract $request) : array
    {
        // todo: validate email correctness
        $val = [];
        if (($val['login'] = empty($request->getData('login')))
            || ($val['name1'] = empty($request->getData('name1')))
            || ($val['type'] = !AccountType::isValidValue((int) $request->getData('type')))
            || ($val['status'] = !AccountStatus::isValidValue((int) $request->getData('status')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create an account
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiAccountCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::CREATE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::ACCOUNT)
        ) {
            $response->set('account_create', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        if (!empty($val = $this->validateAccountCreate($request))) {
            $response->set('account_create', new FormValidation($val));

            return;
        }

        $account = $this->createAccountFromRequest($request);

        AccountMapper::create($account);
        $response->set($request->__toString(), [
            'status' => 'ok',
            'title' => 'Account',
            'message' => 'Account successfully created.',
            'response' => $account->jsonSerialize()
        ]);
    }

    /**
     * Method to create an account from a request
     *
     * @param RequestAbstract $request Request
     *
     * @return Account
     *
     * @since  1.0.0
     */
    private function createAccountFromRequest(RequestAbstract $request) : Account
    {
        $account = new Account();
        $account->setStatus((int) ($request->getData('status') ?? AccountStatus::INACTIVE));
        $account->setType((int) ($request->getData('type') ?? AccountType::USER));
        $account->setName((string) ($request->getData('login') ?? ''));
        $account->setName1((string) ($request->getData('name1') ?? ''));
        $account->setName2((string) ($request->getData('name2') ?? ''));
        $account->setName3((string) ($request->getData('name3') ?? ''));
        $account->setEmail((string) ($request->getData('email') ?? ''));
        $account->generatePassword((string) ($request->getData('password') ?? ''));

        return $account;
    }

    /**
     * Api method to delete an account
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiAccountDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::DELETE, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::ACCOUNT)
        ) {
            $response->set('account_delete', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $account = AccountMapper::get((int) ($request->getData('id')));
        $status  = AccountMapper::delete($account);

        $response->set($request->__toString(), [
            'status' => 'ok',
            'title' => 'Account',
            'message' => 'Account successfully deleted.',
            'response' => $status
        ]);
    }

    /**
     * Api method to update an account
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiAccountUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
    {
        if (!$this->app->accountManager->get($request->getHeader()->getAccount())->hasPermission(
            PermissionType::MODIFY, $this->app->orgId, $this->app->appName, self::MODULE_ID, PermissionState::ACCOUNT)
        ) {
            $response->set('account_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $account = $this->updateAccountFromRequest($request);
        $status  = AccountMapper::update($account);

        $response->set($request->__toString(), [
            'status' => 'ok',
            'title' => 'Account',
            'message' => 'Account successfully updated.',
            'response' => $account->jsonSerialize()
        ]);
    }

    /**
     * Method to update an account from a request
     *
     * @param RequestAbstract $request Request
     *
     * @return Account
     *
     * @since  1.0.0
     */
    private function updateAccountFromRequest(RequestAbstract $request) : Account
    {
        $account = AccountMapper::get((int) ($request->getData('id')));
        $account->setName((string) ($request->getData('login') ?? $account->getName()));
        $account->setName1((string) ($request->getData('name1') ?? $account->getName1()));
        $account->setName2((string) ($request->getData('name2') ?? $account->getName2()));
        $account->setName3((string) ($request->getData('name3') ?? $account->getName3()));
        $account->setEmail((string) ($request->getData('email') ?? $account->getEmail()));
        $account->setStatus((int) ($request->getData('status') ?? $account->getStatus()));
        $account->setType((int) ($request->getData('type') ?? $account->getType()));

        return $account;
    }

    /**
     * Api method to update the module settigns
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function apiModuleStatusUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) /* : void */
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
