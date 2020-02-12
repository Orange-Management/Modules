<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\tests\Admin\Controller\Api;

use phpOMS\Account\PermissionOwner;
use phpOMS\Account\PermissionType;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Uri\HttpUri;

trait ApiControllerPermissionTrait
{
    /**
     * @testdox A permission can be added to a user group
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAddGroupPermission() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::GROUP);
        $request->setData('permissionref', 1);

        $this->module->apiAddGroupPermission($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A group permission can be returned
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiGroupPermissionGet() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '2');

        $this->module->apiGroupPermissionGet($request, $response);

        self::assertEquals(1, $response->get('')['response']->getGroup());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A user group permission can be created and deleted
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiGroupPermissionCreateDelete() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::GROUP);
        $request->setData('permissionref', 1);

        $this->module->apiAddGroupPermission($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
        self::assertGreaterThan(0, $response->get('')['response']->getId());

        // test delete
        $request->setData('id', $response->get('')['response']->getId());
        $this->module->apiGroupPermissionDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A permission with missing data cannot be added to a user group
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAddGroupPermissionInvalidData() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::GROUP);

        $this->module->apiAddGroupPermission($request, $response);
        self::assertEquals('validation', $response->get('permission_create')::TYPE);
    }

    /**
     * @testdox A invalid permission type cannot be added to a user group
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAddGroupPermissionInvalidType() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::ACCOUNT);
        $request->setData('permissionref', 1);

        $this->module->apiAddGroupPermission($request, $response);
        self::assertEquals('validation', $response->get('permission_create')::TYPE);
    }

    /**
     * @testdox A user group permission can be updated
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiGroupPermissionUpdate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $request->setData('permissionread', PermissionType::READ);

        $this->module->apiGroupPermissionUpdate($request, $response);

        self::assertEquals(PermissionType::READ, $response->get('')['response']->getPermission());
        self::assertGreaterThan(0, $response->get('')['response']->getId());

        $request->setData('permissioncreate', PermissionType::CREATE);
        $request->setData('permissionupdate', PermissionType::MODIFY);
        $request->setData('permissiondelete', PermissionType::DELETE);
        $request->setData('permissionpermission', PermissionType::PERMISSION);

        $this->module->apiGroupPermissionUpdate($request, $response);
    }

    /**
     * @testdox A permission can be added to a user
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAddAccountPermission() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::ACCOUNT);
        $request->setData('permissionref', 1);

        $this->module->apiAddAccountPermission($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A user permission can be returned
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountPermissionGet() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiAccountPermissionGet($request, $response);

        self::assertEquals(1, $response->get('')['response']->getAccount());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A user permission can be created and deleted
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountPermissionCreateDelete() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::ACCOUNT);
        $request->setData('permissionref', 1);

        $this->module->apiAddAccountPermission($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
        self::assertGreaterThan(0, $response->get('')['response']->getId());

        // test delete
        $request->setData('id', $response->get('')['response']->getId());
        $this->module->apiAccountPermissionDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A permission with missing data cannot be added to a user
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAddAccountPermissionInvalidData() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::ACCOUNT);

        $this->module->apiAddAccountPermission($request, $response);
        self::assertEquals('validation', $response->get('permission_create')::TYPE);
    }

    /**
     * @testdox A invalid permission type cannot be added to a user
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAddAccountPermissionInvalidType() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('permissionowner', PermissionOwner::GROUP);
        $request->setData('permissionref', 1);

        $this->module->apiAddAccountPermission($request, $response);
        self::assertEquals('validation', $response->get('permission_create')::TYPE);
    }

    /**
     * @testdox A user permission can be updated
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountPermissionUpdate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $request->setData('permissionread', PermissionType::READ);

        $this->module->apiAccountPermissionUpdate($request, $response);

        self::assertEquals(PermissionType::READ, $response->get('')['response']->getPermission());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }
}
