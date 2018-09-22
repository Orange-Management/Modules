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

namespace Modules\Admin\Controller;

use Model\Message\FormValidation;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\AccountMapper;
use Modules\Admin\Models\AccountPermission;
use Modules\Admin\Models\AccountPermissionMapper;
use Modules\Admin\Models\NullAccountPermission;
use Modules\Admin\Models\Group;
use Modules\Admin\Models\GroupMapper;
use Modules\Admin\Models\GroupPermission;
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
use phpOMS\System\MimeType;
use phpOMS\Utils\Parser\Markdown\Markdown;
use phpOMS\Module\InfoManager;
use phpOMS\Account\PermissionAbstract;
use phpOMS\Account\PermissionOwner;

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
final class ApiController extends Controller
{
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
        if (empty($request->getData('settings'))) {
            $data = $request->getLike('(settings_)(.*)');
        } else {
            $data = \json_decode((string) $request->getData('settings'), true);
        }

        $this->app->eventManager->trigger('PRE:Module:Admin-settings-set', '', $data);
        $this->app->appSettings->set($data, true);
        $this->app->eventManager->trigger('POST:Module:Admin-settings-set', '', $data);

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

        $this->app->eventManager->trigger('PRE:Module:Admin-group-update', '', $group);
        GroupMapper::update($group);
        $this->app->eventManager->trigger('POST:Module:Admin-group-update', '', $group);

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

        $this->app->eventManager->trigger('PRE:Module:Admin-group-create', '', $group);
        GroupMapper::create($group);
        $this->app->eventManager->trigger('POST:Module:Admin-group-create', '', $group);

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

        $this->app->eventManager->trigger('PRE:Module:Admin-group-delete', '', $group);
        $status = GroupMapper::delete($group);
        $this->app->eventManager->trigger('POST:Module:Admin-group-delete', '', $group);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
            'title' => 'Group',
            'message' => 'Group successfully deleted.',
            'response' => $status
        ]);
    }

    /**
     * Api method to find groups
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
    public function apiGroupFind(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $response->set(
            $request->getUri()->__toString(),
            \array_values(
                GroupMapper::find((string) ($request->getData('search') ?? ''))
            )
        );
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

        $this->app->eventManager->trigger('PRE:Module:Admin-account-create', '', $account);
        AccountMapper::create($account);
        $this->app->eventManager->trigger('POST:Module:Admin-account-create', '', $account);

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

        $this->app->eventManager->trigger('PRE:Module:Admin-account-delete', '', $account);
        $status = AccountMapper::delete($account);
        $this->app->eventManager->trigger('POST:Module:Admin-account-delete', '', $account);

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

        $this->app->eventManager->trigger('PRE:Module:Admin-account-update', '', $account);
        $status = AccountMapper::update($account);
        $this->app->eventManager->trigger('POST:Module:Admin-account-update', '', $account);

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

        if (empty($module) || empty($status)) {
            $response->set('module_stutus_update', null);
            $response->getHeader()->setStatusCode(RequestStatusCode::R_403);
            return;
        }

        $this->app->eventManager->trigger('PRE:Module:Admin-module-status', '', ['status' => $status, 'module' => $module]);
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
        $this->app->eventManager->trigger('POST:Module:Admin-module-status', '', ['status' => $status, 'module' => $module]);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => $done ? 'ok' : 'warning',
            'title' => 'Module',
            'message' => $msg,
            'response' => []
        ]);
    }

    /**
     * Api method to add a permission to a group
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
    public function apiAddGroupPermission(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validatePermissionCreate($request))) {
            $response->set('permission_create', new FormValidation($val));

            return;
        }

        $permission = $this->createPermissionFromRequest($request);

        if (!($permission instanceof GroupPermission)) {
            return;
        }

        $this->app->eventManager->trigger('PRE:Module:Admin-group-permission-create', '', $permission);
        GroupPermissionMapper::create($permission);
        $this->app->eventManager->trigger('POST:Module:Admin-group-permission-create', '', $permission);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
            'title' => 'Group',
            'message' => 'Group permission successfully created.',
            'response' => $permission->jsonSerialize()
        ]);
    }

    /**
     * Api method to add a permission to a account
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
    public function apiAddAccountPermission(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validatePermissionCreate($request))) {
            $response->set('permission_create', new FormValidation($val));

            return;
        }

        $permission = $this->createPermissionFromRequest($request);

        if (!($permission instanceof AccountPermission)) {
            return;
        }

        $this->app->eventManager->trigger('PRE:Module:Admin-account-permission-create', '', $permission);
        AccountPermissionMapper::create($permission);
        $this->app->eventManager->trigger('POST:Module:Admin-account-permission-create', '', $permission);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => NotificationLevel::OK,
            'title' => 'Account',
            'message' => 'Account permission successfully created.',
            'response' => $permission->jsonSerialize()
        ]);
    }

    /**
     * Validate permission create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since  1.0.0
     */
    private function validatePermissionCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['permissionowner'] = !PermissionOwner::isValidValue((int) $request->getData('permissionowner')))
            || ($val['permissionref'] = !\is_numeric($request->getData('permissionref')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create a permission from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return AccountPermission|GroupPermission
     *
     * @since  1.0.0
     */
    public function createPermissionFromRequest(RequestAbstract $request) : PermissionAbstract
    {
        $permission = ((int) $request->getData('permissionowner')) === PermissionOwner::GROUP ? new GroupPermission((int) $request->getData('permissionref')) : new AccountPermission((int) $request->getData('permissionref'));
        $permission->setUnit(empty($request->getData('permissionunit')) ? null : (int) $request->getData('permissionunit'));
        $permission->setApp(empty($request->getData('permissionapp')) ? null : (string) $request->getData('permissionapp'));
        $permission->setModule(empty($request->getData('permissionmodule')) ? null : (string) $request->getData('permissionmodule'));
        $permission->setType(empty($request->getData('permissiontype')) ? null : (int) $request->getData('permissiontype'));
        $permission->setElement(empty($request->getData('permissionelement')) ? null : (int) $request->getData('permissionelement'));
        $permission->setComponent(empty($request->getData('permissioncomponent')) ? null : (int) $request->getData('permissioncomponent'));
        $permission->setPermission(
            (int) $request->getData('permissioncreate')
            | (int) $request->getData('permissionread')
            | (int) $request->getData('permissionupdate')
            | (int) $request->getData('permissiondelete')
            | (int) $request->getData('permissionpermission')
        );

        return $permission;
    }

    /**
     * Api method to add a group to an account
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
    public function apiAddGroupToAccount(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $account = (int) $request->getData('account');
        $groups  = \array_map('intval', $request->getDataList('igroup-idlist'));

        $this->app->eventManager->trigger('PRE:Module:Admin-account-group-add', '', ['account' => $account, 'groups' => $groups]);
        $success = AccountMapper::createRelation('groups', $account, $groups);
        $this->app->eventManager->trigger('POST:Module:Admin-account-group-add', '', ['account' => $account, 'groups' => $groups]);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Account',
            'message' => 'Group added to account',
            'response' => []
        ]);
    }

    /**
     * Api method to add an account to a group
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
    public function apiAddAccountToGroup(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $group    = (int) $request->getData('group');
        $accounts = \array_map('intval', $request->getDataList('iaccount-idlist'));

        $this->app->eventManager->trigger('PRE:Module:Admin-group-account-add', '', ['group' => $group, 'accounts' => $accounts]);
        $success = GroupMapper::createRelation('accounts', $group, $accounts);
        $this->app->eventManager->trigger('POST:Module:Admin-group-account-add', '', ['group' => $group, 'accounts' => $accounts]);

        $response->getHeader()->set('Content-Type', MimeType::M_JSON, true);
        $response->set($request->getUri()->__toString(), [
            'status' => 'ok',
            'title' => 'Group',
            'message' => 'Account added to group',
            'response' => []
        ]);
    }
}
