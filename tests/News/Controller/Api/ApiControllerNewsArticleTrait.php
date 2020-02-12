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

namespace Modules\tests\News\Controller\Api;

use Modules\News\Models\NewsStatus;
use Modules\News\Models\NewsType;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Uri\HttpUri;

trait ApiControllerNewsArticleTrait
{
    /**
    * @testdox A news article can be created
    * @covers Modules\News\Controller\ApiController
     * @group module
     */
    public function testApiNewsCreate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('title', 'Controller Test Title');
        $request->setData('plain', 'Controller Test Content');
        $request->setData('lang', 'en');
        $request->setData('type', NewsType::ARTICLE);
        $request->setData('status', NewsStatus::DRAFT);
        $request->setData('featred', true);

        $this->module->apiNewsCreate($request, $response);

        self::assertEquals('Controller Test Title', $response->get('')['response']->getTitle());
        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A news article can be returned
     * @covers Modules\News\Controller\ApiController
     * @group module
     */
    public function testApiNewsGet() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1');

        $this->module->apiNewsGet($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }

    /**
     * @testdox A news article can be updated
     * @covers Modules\News\Controller\ApiController
     * @group module
     */
    public function testApiNewsUpdate() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $request->setData('title', 'New Title');
        $request->setData('plain', 'New Content here');

        $this->module->apiNewsUpdate($request, $response);
        $this->module->apiNewsGet($request, $response);

        self::assertEquals('New Title', $response->get('')['response']->getTitle());
    }

    /**
     * @testdox A news article can be deleted
     * @covers Modules\News\Controller\ApiController
     * @group module
     */
    public function testApiNewsDelete() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', 1);
        $this->module->apiNewsDelete($request, $response);

        self::assertGreaterThan(0, $response->get('')['response']->getId());
    }
}
