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

use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Uri\HttpUri;

trait ApiControllerAccountTrait
{
    /**
     * @testdox A user can be returned
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountGet() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiAccountGet($request, $response);

        self::assertEquals('admin', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A user can be updated
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountUpdate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $request->setData('email', 'oms@orange-management.de');

        $this->module->apiAccountUpdate($request, $response);
        $this->module->apiAccountGet($request, $response);

        self::assertEquals('oms@orange-management.de', $response->get('')['response']->getEmail());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A user can be found by name
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountFind() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('search', 'admin');

        $this->module->apiAccountFind($request, $response);
        self::assertCount(1, $response->get(''));
        self::assertEquals('admin', $response->get('')[0]->getName1());
    }

    /**
     * @testdox A user and profile for the user can be created
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountAndProfileCreate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('login', 'guest');
        $request->setData('password', 'guest');
        $request->setData('name1', 'Guest');
        $request->setData('email', 'test@email.com');
        $request->setData('type', AccountType::USER);
        $request->setData('status', AccountStatus::INACTIVE);

        $this->module->apiAccountCreate($request, $response);

        self::assertEquals('guest', $response->get('')['response']->getName());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A user can be deleted
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountDelete() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        // mustn't create a profile otherwise it will not be possible to delete the account because of FK constraints
        $request->setData('name1', 'Guest');
        $request->setData('email', 'test@email.com');
        $request->setData('type', AccountType::USER);
        $request->setData('status', AccountStatus::INACTIVE);

        $this->module->apiAccountCreate($request, $response);
        $request->setData('id', $response->get('')['response']->getId());
        $this->module->apiAccountDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A invalid user cannot be created
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAccountCreateInvalid() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('status', 999);
        $request->setData('description', 'test description');

        $this->module->apiAccountCreate($request, $response);
        self::assertEquals('validation', $response->get('account_create')::TYPE);
    }

    /**
     * @testdox A user group can be added to a user
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiAddGroupToAccount() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('account', 1);
        $request->setData('igroup-idlist', '1');

        $this->module->apiAddGroupToAccount($request, $response);
        self::assertEquals('ok', $response->get('')['status']);
    }
}
