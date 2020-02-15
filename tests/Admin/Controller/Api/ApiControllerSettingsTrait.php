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

use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Uri\HttpUri;

trait ApiControllerSettingsTrait
{
    /**
     * @testdox Application settings can be read from the database
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiSettingsGet() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('name', '1000000019');

        $this->module->apiSettingsGet($request, $response);
        self::assertEquals('DE', $response->get('')['response']);
    }

    /**
     * @testdox Application settings can be set in the database
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiSettingsSet() : void
    {
        $response = new HttpResponse();
        $request  = new HttpRequest(new HttpUri(''));

        $request->getHeader()->setAccount(1);
        $request->setData('settings', \json_encode([['name' => '1000000019', 'content' => 'US']]));
        $this->module->apiSettingsSet($request, $response);

        $request->setData('name', '1000000019');
        $this->module->apiSettingsGet($request, $response);
        self::assertEquals('US', $response->get('')['response']);
    }
}
