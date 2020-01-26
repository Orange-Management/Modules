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

use phpOMS\Message\Http\Request;
use phpOMS\Message\Http\Response;
use phpOMS\Uri\Http;

trait ApiControllerSettingsTrait
{
    /**
     * @testdox Application settings can be read from the database
     * @covers Modules\Admin\Controller\ApiController
     * @group module
     */
    public function testApiSettingsGet() : void
    {
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('id', '1000000019');

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
        $response = new Response();
        $request  = new Request(new Http(''));

        $request->getHeader()->setAccount(1);
        $request->setData('settings', \json_encode(['1000000019' => 'US']));
        $this->module->apiSettingsSet($request, $response);

        $request->setData('id', '1000000019');
        $this->module->apiSettingsGet($request, $response);
        self::assertEquals('US', $response->get('')['response']);
    }
}
