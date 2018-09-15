<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
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
use Modules\Admin\Models\ModuleStatusUpdateType;

use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;
use phpOMS\Account\GroupStatus;
use phpOMS\Account\PermissionType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Message\NotificationLevel;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Module\ModuleAbstract;
use phpOMS\Module\WebInterface;
use phpOMS\System\MimeType;
use phpOMS\Utils\Parser\Markdown\Markdown;
use phpOMS\Views\View;
use phpOMS\DataStorage\Database\RelationType;
use phpOMS\Module\InfoManager;

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
final class Controller extends ModuleAbstract implements WebInterface
{

    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_PATH = __DIR__;

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    public const MODULE_NAME = 'Admin';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const MODULE_ID = 1000100000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $providing = [];

    /**
     * Dependencies.
     *
     * @var string[]
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
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewEmptyCommand(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
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
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewAccountList(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
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
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewAccountSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Admin/Theme/Backend/accounts-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000104001, $request, $response));
        $view->addData('account', AccountMapper::get((int) $request->getData('id'), RelationType::ALL, null, 2));

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
     * @return \Serializable Serializable web view
     *
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function viewGroupSettings(RequestAbstract $request, ResponseAbstract $response, $data = null) : \Serializable
    {
        $view = new View($this->app, $request, $response);

        $view->setTemplate('/Modules/Admin/Theme/Backend/groups-single');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000103001, $request, $response));
        $view->addData('group', GroupMapper::get((int) $request->getData('id'), RelationType::ALL, null, 2));

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

        $view->setTemplate('/Modules/Admin/Theme/Backend/modules-single');

        $id = $request->getData('id') ?? '';
        $view->setData('modules', $this->app->moduleManager->getAllModules());
        $view->setData('active', $this->app->moduleManager->getActiveModules());
        $view->setData('installed', $installed = $this->app->moduleManager->getInstalledModules());
        $view->setData('id', $id);

        if (isset($installed[$id]) && ($path = \realpath(__DIR__ . '/../' . $id . '/info.json')) !== false) {
            $info = new InfoManager($path);
            $info->load();

            $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(
                $info->getId(),
                $request, $response
            ));
        }

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
     * @api
     *
     * @since  1.0.0
     */
    public function apiSettingsGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $response->set(
            $request->getUri()->__toString(),
            [
                'response' => $this->app->appSettings->get((int) $request->getData('id'))
            ]
        );
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
     * @api
     *
     * @since  1.0.0
     */
    public function apiSettingsSet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if ($request->getData('settings') === null) {
            $data = $request->getLike('(settings_)(.*)');
        } else {
            $data = \json_decode((string) $request->getData('settings'), true);
        }

        $this->app->appSettings->set($data, true);

        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
            'title' => 'Settings',
            'message' => 'Settings successfully modified.',
            'response' => $data
        ]);
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
     * @api
     *
     * @since  1.0.0
     */
    public function apiGroupGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $group = GroupMapper::get((int) $request->getData('id'));
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
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
     * @api
     *
     * @since  1.0.0
     */
    public function apiGroupUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $group = $this->updateGroupFromRequest($request);

        GroupMapper::update($group);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
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
     * @return array<string, bool>
     *
     * @since  1.0.0
     */
    private function validateGroupCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = empty($request->getData('name')))
            || ($val['status'] = !GroupStatus::isValidValue((int) $request->getData('status')))
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
     * @api
     *
     * @since  1.0.0
     */
    public function apiGroupCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateGroupCreate($request))) {
            $response->set('group_create', new FormValidation($val));

            return;
        }

        $group = $this->createGroupFromRequest($request);

        $this->app->eventManager->trigger('PRE:Module:Admin-groupcreate', '', $group);
        GroupMapper::create($group);
        $this->app->eventManager->trigger('POST:Module:Admin-groupcreate', '', $group);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
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
     * @api
     *
     * @since  1.0.0
     */
    public function apiGroupDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $group = GroupMapper::get((int) $request->getData('id'));

        $this->app->eventManager->trigger('PRE:Module:Admin-groupdelete', '', $group);
        $status = GroupMapper::delete($group);
        $this->app->eventManager->trigger('POST:Module:Admin-groupdelete', '', $group);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
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
     * @api
     *
     * @since  1.0.0
     */
    public function apiAccountGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $account = AccountMapper::get((int) $request->getData('id'));

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
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
     * @api
     *
     * @since  1.0.0
     */
    public function apiAccountFind(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $response->set(
            $request->getUri()->__toString(),
            \array_values(
                AccountMapper::find((string) ($request->getData('search') ?? ''))
            )
        );
    }

    /**
     * Method to validate account creation from request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
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
     * @api
     *
     * @since  1.0.0
     */
    public function apiAccountCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateAccountCreate($request))) {
            $response->set('account_create', new FormValidation($val));

            return;
        }

        $account = $this->createAccountFromRequest($request);

        $this->app->eventManager->trigger('PRE:Module:Admin-accountcreate', '', $account);

        AccountMapper::create($account);

        $this->app->eventManager->trigger('POST:Module:Admin-accountcreate', '', $account);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
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
     * @api
     *
     * @since  1.0.0
     */
    public function apiAccountDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $account = AccountMapper::get((int) ($request->getData('id')));

        $this->app->eventManager->trigger('PRE:Module:Admin-accountdelete', '', $account);
        $status = AccountMapper::delete($account);
        $this->app->eventManager->trigger('POST:Module:Admin-accountdelete', '', $account);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
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
     * @api
     *
     * @since  1.0.0
     */
    public function apiAccountUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $account = $this->updateAccountFromRequest($request, true);
        $status  = AccountMapper::update($account);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
            'title' => 'Account',
            'message' => 'Account successfully updated.',
            'response' => $account->jsonSerialize()
        ]);
    }

    /**
     * Method to update an account from a request
     *
     * @param RequestAbstract $request       Request
     * @param bool            $allowPassword Allow to change password
     *
     * @return Account
     *
     * @since  1.0.0
     */
    private function updateAccountFromRequest(RequestAbstract $request, bool $allowPassword = false) : Account
    {
        $account = AccountMapper::get((int) ($request->getData('id')));
        $account->setName((string) ($request->getData('login') ?? $account->getName()));
        $account->setName1((string) ($request->getData('name1') ?? $account->getName1()));
        $account->setName2((string) ($request->getData('name2') ?? $account->getName2()));
        $account->setName3((string) ($request->getData('name3') ?? $account->getName3()));
        $account->setEmail((string) ($request->getData('email') ?? $account->getEmail()));
        $account->setStatus((int) ($request->getData('status') ?? $account->getStatus()));
        $account->setType((int) ($request->getData('type') ?? $account->getType()));

        if ($allowPassword && !empty($request->getData('password'))) {
            $account->generatePassword((string) $request->getData('password'));
        }

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
     * @api
     *
     * @since  1.0.0
     */
    public function apiModuleStatusUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $module = $request->getData('module');
        $status = (int) $request->getData('status');

        if ($module === null || $status === null) {
            $response->set('module_stutus_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        switch ($status) {
            case ModuleStatusUpdateType::ACTIVATE:
                $done = $module === 'Admin' ? false : $this->app->moduleManager->activate($module);
                $msg  = $done ? 'Module successfully activated.' : 'Module not activated.';

                break;
            case ModuleStatusUpdateType::DEACTIVATE:
                $done = $module === 'Admin' ? false : $this->app->moduleManager->deactivate($module);
                $msg  = $done ? 'Module successfully deactivated.' : 'Module not deactivated.';

                break;
            case ModuleStatusUpdateType::INSTALL:
                $done = $module === 'Admin' ? false : $this->app->moduleManager->install($module);
                $msg  = $done ? 'Module successfully installed.' : 'Module not installed.';

                break;
            case ModuleStatusUpdateType::UNINSTALL:
                $done = $module === 'Admin' ? false : $this->app->moduleManager->uninstall($module);
                $msg  = $done ? 'Module successfully uninstalled.' : 'Module not uninstalled.';

                break;
            default:
                $done = false;
                $msg  = 'Unknown module status change request.';
        }

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => $done ? 'ok' : 'warning',
            'title' => 'Module',
            'message' => $msg,
            'response' => []
        ]);
    }
}
